<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FactureAirtel as FactureExport;
use App\Imports\FactureAirtel as Facture;
use Illuminate\Support\Facades\DB;

class FactureAirtel extends Component
{
     use WithFileUploads;
     use WithPagination;
     protected $paginationTheme = 'bootstrap';

    public $file;
    public $mois = '';
    public $annee = '';
    public $annees = [];
    public $Facture_telma = "";
    public $selected = [];
    public $selectAll = false;
    public $recherche = '';
    public $totaux = [];

    public function calculFacture($annee,$mois,$facture){
        
    $contacts = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->get();
    $TOTAL_IT = 0;
    $this->totaux['inconnu'] = [];
    //$code_budgetaires = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->select('budget')->distinct()->get();
    $factures = DB::connection('mysql_second')
                        ->table('facture_airtel')
                        ->when($this->mois, function ($q) {
                            $q->whereMonth('Date', $this->mois);
                        })
                        ->when($this->annee, function ($q) {
                            $q->whereYear('Date', $this->annee);
                        })
                        ->get();
                     $tot = 0;
                    foreach ($factures as $facture) {
                $trouve = false; // On initialise un indicateur

                foreach ($contacts as $contact) {
                    if ($contact->airtel == $facture->MSISDN) {
                        // On a trouvé le contact !
                        if (isset($this->totaux[$contact->budget][$facture->MSISDN])) {
                            $this->totaux[$contact->budget][$facture->MSISDN] += floatval($facture->TOTAL_PAYER);
                        } else {
                            $this->totaux[$contact->budget][$facture->MSISDN] = floatval($facture->TOTAL_PAYER);
                        }
                        $trouve = true; // On marque comme trouvé
                        break; // On arrête de chercher dans les contacts pour cette facture
                    }
                }

                // C'est SEULEMENT ici, après la boucle des contacts, qu'on vérifie si on l'a trouvé
                if (!$trouve) {
                    $this->totaux['inconnu'][$facture->MSISDN] = ($this->totaux['inconnu'][$facture->MSISDN] ?? 0) + floatval($facture->TOTAL_PAYER);
                }
            }
                //dd($tot);
        $total_general = 0;

        foreach ($this->totaux as $budget => $numeros) {
            // On additionne la somme de chaque sous-tableau
            $total_general += array_sum($numeros);
        }
       //dd($this->totaux,$total_general);
        $this->dispatch('reload-after-download');
        return Excel::download(new FactureExport($this->totaux), 'facturation_pivot_airtel' . $this->annee . '-' . $this->mois . '.xlsx');
        
       
        //$code_budgetaires = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->select('budget')->distinct()->get();                
    }

    public function genererAnnees()
    {
        $anneeActuelle = date('Y'); // année actuelle

        // ex: 10 années en arrière + 5 années en avant
        for ($i = $anneeActuelle - 5; $i <= $anneeActuelle + 5; $i++) {
            $this->annees[] = $i;
        }
    }

    public function mount()
    {
        $this->genererAnnees();
        $this->selected;
    }



    public function deleteSelected()
{
    DB::connection('mysql_second')->table('facture_airtel')
        ->whereIn('id', $this->selected)
        ->delete();

    $this->selected = [];
    $this->selectAll = false;

    session()->flash('success', 'Suppression réussie ✅');
}
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = DB::connection('mysql_second')->table('facture_airtel')
                ->pluck('id')
                ->toArray();
        } else {
            $this->selected = [];
        }
    }


     public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,csv,txt'
        ]);

        Excel::import(new Facture, $this->file);

        session()->flash('success', 'Import facture réussi ✅');

        // reset input
        $this->reset('file');
    }

    public function render()
    {
        $factures = DB::connection('mysql_second')
        ->table('facture_airtel')
        
        ->when($this->mois, function ($query) {
            return $query->whereMonth('Date', $this->mois);
        })

        ->when($this->annee, function ($query) {
            return $query->whereYear('Date', $this->annee);
        })

        ->when($this->Facture_telma, function ($query) {
            return $query->where('Facture_telma', $this->Facture_telma);
        })

        ->when($this->recherche, function ($query) {
            return $query->where(function ($q) {
                $q->where('MSISDN', 'like', '%' . $this->recherche . '%')
                ->orWhere('N_DOSSIER', 'like', '%' . $this->recherche . '%')
                ->orWhere('N_facture', 'like', '%' . $this->recherche . '%');
            });
        })

        ->orderBy('Date', 'desc')
        ->paginate(25);
        return view('livewire.facture-airtel',[
            'factures' => $factures,
            
        ]);
    }
}

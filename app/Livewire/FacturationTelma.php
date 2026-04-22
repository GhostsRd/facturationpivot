<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TotauxFacturationExport;
use App\Imports\Facture;
use Illuminate\Support\Facades\DB;

class FacturationTelma extends Component
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


    /*$airtel = trim($c->airtel);
    $telma = trim($c->telma);
    $orange = trim($c->airtel);

    $airtel = preg_replace('/[^\d+]/', '', $airtel);
    $telma = preg_replace('/[^\d+]/', '', $telma);
    $orange = preg_replace('/[^\d+]/', '', $orange);

    $data = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->where('id',$c->id)->update([
        'airtel' => $airtel,
        'telma' => $telma,
        'orange' => $orange,

    ]);*/
    public function calculFacture($annee,$mois,$facture){
        
    $contacts = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->get();
    $TOTAL_IT = 0;
    $this->totaux['inconnu'] = [];
    //$code_budgetaires = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->select('budget')->distinct()->get();
    $factures = DB::connection('mysql_second')
                        ->table('facture')
                        ->when($this->mois, function ($q) {
                            $q->whereMonth('Date', $this->mois);
                        })
                        ->when($this->annee, function ($q) {
                            $q->whereYear('Date', $this->annee);
                        })
                        ->when($this->Facture_telma, function ($q) {
                            $q->where('Facture_telma', $this->Facture_telma);
                        })
                        ->get();
                     $tot = 0;
                    foreach ($factures as $facture) {
                $trouve = false; // On initialise un indicateur

                foreach ($contacts as $contact) {
                    if ($contact->telma == $facture->msisdn) {
                        // On a trouvé le contact !
                        if (isset($this->totaux[$contact->budget][$facture->msisdn])) {
                            $this->totaux[$contact->budget][$facture->msisdn] += intval($facture->Montant_TTC);
                        } else {
                            $this->totaux[$contact->budget][$facture->msisdn] = intval($facture->Montant_TTC);
                        }
                        $trouve = true; // On marque comme trouvé
                        break; // On arrête de chercher dans les contacts pour cette facture
                    }
                }

                // C'est SEULEMENT ici, après la boucle des contacts, qu'on vérifie si on l'a trouvé
                if (!$trouve) {
                    $this->totaux['inconnu'][$facture->msisdn] = ($this->totaux['inconnu'][$facture->msisdn] ?? 0) + intval($facture->Montant_TTC);
                }
            }
                //dd($tot);
        $total_general = 0;

        foreach ($this->totaux as $budget => $numeros) {
            // On additionne la somme de chaque sous-tableau
            $total_general += array_sum($numeros);
        }
        //dd($this->totaux,$total_general);
        return Excel::download(new TotauxFacturationExport($this->totaux), 'facturation_pivot.xlsx');
        //$code_budgetaires = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->select('budget')->distinct()->get();                
    }

    public function deleteSelected()
{
    DB::connection('mysql_second')->table('facture')
        ->whereIn('id', $this->selected)
        ->delete();

    $this->selected = [];
    $this->selectAll = false;

    session()->flash('success', 'Suppression réussie ✅');
}
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = DB::connection('mysql_second')->table('facture')
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
        ->table('facture')
        ->when($this->mois, function ($q) {
        $q->whereMonth('Date', $this->mois);})
        ->when($this->annee, function ($q) {
            $q->whereYear('Date', $this->annee);
        })
        ->when($this->Facture_telma, function ($q) {
            $q->where('Facture_telma', $this->Facture_telma);
        })
        ->when($this->Facture_telma, function ($q) {
            $q->where('Facture_telma', $this->Facture_telma);
        })
        ->when($this->recherche, function ($q) {
            $q->where('msisdn', 'like', '%' . $this->recherche . '%');
        })

        ->orderBy('Date', 'desc')
        ->paginate(25);

        return view('livewire.facturation-telma',[
            'factures'=> $factures,
            'filtrefactures' => DB::connection('mysql_second')->table('facture')->select('Facture_telma')->distinct()->orderBy('Facture_telma','desc')->get()
        ]);
    }

    

   
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
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
    }


    public function calculFacture($annee,$mois,$facture){

    $contacts = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->get();
    $TOTAL_IT = 0;
    foreach($contacts as $c){
      $airtel = trim($c->airtel);
        $telma = trim($c->telma);
        $orange = trim($c->airtel);

        $airtel = preg_replace('/[^\d+]/', '', $airtel);
        $telma = preg_replace('/[^\d+]/', '', $telma);
        $orange = preg_replace('/[^\d+]/', '', $orange);

        $data = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->where('id',$c->id)->update([
            'airtel' => $airtel,
            'telma' => $telma,
            'orange' => $orange,

        ]);
        
        if($c->budget == "AS6-OPS-MVT"){
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
                    ->where('msisdn', $c->telma)->get();
                    foreach ($factures as $f) {
                      
                        $TOTAL_IT = $TOTAL_IT + $f->Montant_TTC;
                    }
                    }
                    
                    }
                    
        dd($TOTAL_IT);
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

        ->orderBy('Date', 'desc')
        ->paginate(25);

        return view('livewire.facturation-telma',[
            'factures'=> $factures,
            'filtrefactures' => DB::connection('mysql_second')->table('facture')->select('Facture_telma')->distinct()->orderBy('Facture_telma','desc')->get()
        ]);
    }

    

   
}

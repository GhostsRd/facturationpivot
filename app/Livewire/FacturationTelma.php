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
    public $Facture_telma = "";
    public $selected = [];
    public $selectAll = false;

    public function deleteSelected()
{
    DB::table('facture')
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
        ->paginate(20);

        return view('livewire.facturation-telma',[
            'factures'=> $factures,
            'filtrefactures' => DB::connection('mysql_second')->table('facture')->select('Facture_telma')->distinct()->orderBy('Facture_telma','desc')->get()
        ]);
    }

    

   
}

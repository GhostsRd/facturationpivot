<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Imports\Contacts;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;


class ContactPivot extends Component
{
    use WithFileUploads;

    public $recherche,$service,$localites;
    public $nom, $prenom, $poste, $services, $localite;
    public $budget, $airtel, $telma, $orange, $mail;
    public $contact_id;
    public $selected = [];
    public $file;
    public $selectAll = false;

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')
                ->pluck('id')
                ->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function deleteSelected()
{
    if (!empty($this->selected)) {

        DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')
            ->whereIn('id', $this->selected)
            ->delete();

        $this->selected = [];

        session()->flash('success', 'Suppression réussie ✅');
    }
}
public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,csv,txt'
        ]);

        Excel::import(new Contacts, $this->file);

        session()->flash('success', 'Import contacts réussi ✅');

        // reset input
        $this->reset('file');
    }

public function resetFilters(){
    $this->reset();
}
    public function store()
{

    DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->insert([
        'nom' => $this->nom,
        'prenom' => $this->prenom,
        'poste' => $this->poste,
        'services' => $this->services,
        'localite' => $this->localite,
        'budget' => $this->budget,
        'airtel' => $this->airtel,
        'telma' => $this->telma,
        'orange' => $this->orange,
        'mail' => $this->mail,
        
    ]);

    $this->reset(); // reset form

    session()->flash('success', 'Contact ajouté ✅');
}
public function edit($id)
{
    $contact = DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')->find($id);

    $this->contact_id = $id;
    $this->nom = $contact->nom;
    $this->prenom = $contact->prenom;
    $this->poste = $contact->poste;
    $this->services = $contact->services;
    $this->localite = $contact->localite;
    $this->budget = $contact->budget;
    $this->airtel = $contact->airtel;
    $this->telma = $contact->telma;
    $this->orange = $contact->orange;
    $this->mail = $contact->mail;
}
public function update()
{
    DB::connection('mysql_second')->table('base_flotte_telephoniques_pivot')
        ->where('id', $this->contact_id)
        ->update([
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'poste' => $this->poste,
            'services' => $this->services,
            'localite' => $this->localite,
            'budget' => $this->budget,
            'airtel' => $this->airtel,
            'telma' => $this->telma,
            'orange' =>$this->orange,
            'mail' => $this->mail,
           // 'updated_at' => now(),
        ]);

    session()->flash('success', 'Contact modifié ✅');

    $this->reset();

    $this->dispatch('close-modal');
}
    public function render()
    {
      
      $contacts = DB::connection('mysql_second')
        ->table('base_flotte_telephoniques_pivot')
        
        ->where(function ($query) {
            $query->where('nom', 'like', '%' . $this->recherche . '%')
                ->orWhere('telma', 'like', '%' . $this->recherche . '%')
                ->orWhere('airtel', 'like', '%' . $this->recherche . '%')
                ->orWhere('orange', 'like', '%' . $this->recherche . '%')
                ->orWhere('localite', 'like', '%' . $this->recherche . '%')
                ->orWhere('budget', 'like', '%' . $this->recherche . '%')
                ->orWhere('services', 'like', '%' . $this->recherche . '%');
        })
        ->when($this->service, function ($q) {
                    $q->where('services', $this->service);})
        ->when($this->localites, function ($q) {
                    $q->where('localite', 'like', '%' . $this->localites . '%');})
        ->orderBy('nom', 'asc')
        ->get();
            return view('livewire.contact-pivot',
        [
            'contacts' => $contacts,
        ]);

    }
}

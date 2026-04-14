<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ContactPivot extends Component
{
    public $recherche;

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
                ->orWhere('services', 'like', '%' . $this->recherche . '%');
        })
        ->get();
            return view('livewire.contact-pivot',
        [
            'contacts' => $contacts,
        ]);

    }
}

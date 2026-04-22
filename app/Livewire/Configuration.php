<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Configuration extends Component
{
    public $id;
    public function render()
    {
        return view('livewire.configuration',
        [
            'clients' => \App\Models\User::all()
        ]);
    }
}

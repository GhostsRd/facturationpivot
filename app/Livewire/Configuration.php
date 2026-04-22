<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Configuration extends Component
{
    public $id;

    public $status = false; // OFF par défaut

    public function toggle($id)
    {
        $user  = User::find($id);

        //dd($user);
        if($user->email_verified_at == null){
            $user->email_verified_at = now(); 
            $user->save();// Activer la vérification
            } else {
            $user->email_verified_at = null; // Désactiver la vérification
            $user->save();
        }
      // User::where('id', $id)->update(['email_verified_at' => now()]);
    }

    public function render()
    {
        return view('livewire.configuration',
        [
            'clients' => \App\Models\User::all()
        ]);
    }
}

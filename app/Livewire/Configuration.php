<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Configuration extends Component
{
    public $id;
    public $name;
    public $email;


    public $status = false; // OFF par défaut
    public function edit($id)
    {
        $client = User::find($id);
        $this->id = $client->id;
        $this->name = $client->name;
        $this->email = $client->email;
        $this->status = $client->email_verified_at ? true : false;
    }
    public function update()
    {
        $client = User::find($this->id);
        $client->name = $this->name;
        $client->email = $this->email;
        $client->save();

        $this->reset(['id', 'name', 'email']);
        $this->dispatch('saved');
    
    }

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
    public function delete($id)
    {
        $user  = User::find($id);
        $user->delete();
    
    }

    public function render()
    {
        return view('livewire.configuration',
        [
            'clients' => \App\Models\User::all()
        ]);
    }
}

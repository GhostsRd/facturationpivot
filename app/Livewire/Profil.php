<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Profil extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $id;
    public $current_password;
    public $new_password;
    public $confirm_password;
    public $profil;

    public function update(User $user)
    {
        $user = User::find(Auth::id());
        
        $user->name = $this->name;
        $user->email = $this->email;
  
        $user->save();
        return redirect()->to('profil/'.$this->name);
    }

    public function changePassword(User $user)
    {
        $user = User::find(Auth::id());
        
        if(!Hash::check($this->current_password, $user->password)){
            session()->flash('error', 'Ancien mot de passe incorrect');
            return;
        }
        if($this->new_password != $this->confirm_password) {
            session()->flash('error', 'Les mots de passe ne correspondent pas');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();
        session()->flash('success', 'Mot de passe mis à jour avec succès');
        $this->reset(['current_password', 'new_password', 'confirm_password']);
       // return redirect()->to('profil/'.$this->name);
    }
    public function edit($name)
    {
        $profil = User::where('name', $name)->first();
        $this->name = $profil->name;
        $this->email = $profil->email;
        //dd($this->email);
        $this->id = $profil->id;
    }

    public function mount($name)
    {
        $this->name = $name;
        $this->email = Auth::user()->email;

       
        
        //dd($this->profil);
    }
    public function render()
    {
        return view('livewire.profil', ['name' => $this->name]);
    }
}

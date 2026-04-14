<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client as clientModels;
class Client extends Component
{
    public $nomclient;
    public $solde;
    public $data;
    public $id;
    
    public function edit($id){

        $client = clientModels::where('num_compte',$id)->first();
        $this->nomclient = $client->nomclient;
        $this->solde = $client->solde;
        $this->id = $id;
        
    }
    public function update(){
        $client = clientModels::where('num_compte',$this->id)->update([
            'nomclient' =>$this->nomclient,
        ]);
        return redirect()->to('/client');

    }
    public function mount(){
        $this->nomclient;
         $this->solde;
         $this->id;
    }
    public function render()
    {
        $this->data = clientModels::where('num_compte',auth()->user()->id)->get();
        
        if(auth()->user()->email == config('app.email') ){
      
            $this->data = clientModels::all();
        }
        
        return view('livewire.client', [
            'clients' => $this->data,
        ]);
    }
    public function store(ClientModels $client){
        $client->nomclient = $this->nomclient; 
        $client->solde = 0; 
        $client->save();
        return redirect()->to('/client');
    }
    public function delete($id){
        clientModels::where('num_compte',$id)->delete();
        return redirect()->to('/client');
    }
    
}

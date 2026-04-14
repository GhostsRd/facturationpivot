<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Versement as ModelVersement;
use App\Models\Client;
use App\Models\Audit_versement;

class Versement extends Component
{
    public $num_cheque;
    public $num_compte;
    public $montant;
    public $num_versement;
    public $current_user;
    public $new_montant;
    public $operation;

    protected $listeners = ['refresh' => '$refresh'];

    public function store(ModelVersement $versenent,Client $client){
        
        //dd($dernier_versement); okokok
        $current_user = Client::where('num_compte',$this->num_compte)->first();
        DB::statement("SET @app_ancien_montant = ?", [$current_user->solde]);
        if($current_user){
            $current_user->solde = $this->montant + $current_user->solde;
            $current_user->save();
            }else{
                echo 'introuvable user';
                }
                $client_nouveausolde = Client::where('num_compte',$this->num_compte)->first();
                //maka le dernier numero de versement plus 1 pour le nouceau
                $exist_versement = ModelVersement::first();
                if($exist_versement != null){
                    $numero_versement = ModelVersement::latest()->first()->num_versement + 1;
                    $num_new_versement =  $numero_versement + 1;
                    DB::statement("SET @app_num_versement = ?", [$numero_versement  ?? null]);
                    }else{
                        DB::statement("SET @app_num_versement = ?", [ 1  ?? null]);
                        }
                        DB::statement("SET @app_type_action = ?", ['CREATION']);
                        DB::statement("SET @app_num_compte = ?", [$this->num_compte ?? null]);
                        DB::statement("SET @app_nom_client = ?", [$current_user->nomclient ?? null]);
                        DB::statement("SET @app_utilisateur = ?", [auth()->user()->name ?? null]);
                        DB::statement("SET @app_nouveau_montant = ?", [$client_nouveausolde->solde]);
                        //dd($exist_versement);
        
        $versenent->num_cheque = $this->num_cheque; 
        $versenent->num_compte = $this->num_compte; 
        $versenent->montant = $this->montant; 
        $versenent->save();
        /*
        DELIMITER $$

        CREATE TRIGGER after_insert_versement
                AFTER INSERT ON versements
                FOR EACH ROW
                BEGIN
                    INSERT INTO audit_versements (
                        type_action,
                        num_versement,
                        num_compte,
                        nom_client,
                        ancien_montant,
                        nouveau_montant,
                        utilisateur,
                        created_at,
                        updated_at
                    )
                    VALUES (
                        @app_type_action,
                        NEW.num_versement,
                        NEW.num_compte,
                        IFNULL(@app_nom_client, 'INCONNU'),
                        IFNULL(@app_ancien_montant, 0),
                        IFNULL(@app_nouveau_montant, NEW.montant),
                        IFNULL(@app_utilisateur, 'SYSTEM'),
                        NOW(),
                        NOW()
                    );
        END$$
        DELIMITER ;


        CREATE TRIGGER after_update_versement AFTER UPDATE ON versements FOR EACH ROW BEGIN INSERT INTO audit_versements ( type_action, num_versement, num_compte, nom_client, ancien_montant, nouveau_montant, utilisateur, created_at, updated_at ) VALUES ( @app_type_action, -- type d'action NEW.num_versement, NEW.num_compte, IFNULL(@app_nom_client, 'INCONNU'), OLD.montant, -- ancien montant NEW.montant, -- nouveau montant IFNULL(@app_utilisateur, 'SYSTEM'), NOW(), NOW() ); END;
 */
    

       $this->reset();
       
    }
    public function verifier_compte(Client $client){
      
        $this->current_user = Client::where('num_compte', $this->num_compte)->first();
    }
    public function edit($id){
  
      $current_versement = ModelVersement::where('num_versement',$id)->first();
      $this->current_user = Client::where('num_compte', $current_versement->num_compte)->first();
      $this->num_compte = $current_versement->num_compte;
      $this->num_cheque= $current_versement->num_cheque;
      $this->montant = $current_versement->montant;
      $this->num_versement = $current_versement->num_versement;


    }

    public function update(){
        /*  DELIMITER $$
CREATE TRIGGER after_update_versement 
AFTER UPDATE ON versements
FOR EACH ROW BEGIN INSERT INTO audit_versements ( type_action, num_versement, num_compte, nom_client, ancien_montant, nouveau_montant, utilisateur, created_at, updated_at ) VALUES 
( @app_type_action, -- type d'action 
 NEW.num_versement,
 NEW.num_compte, 
 IFNULL(@app_nom_client, 'INCONNU'), 
 IFNULL(@app_ancien_montant, 0), -- ancien montant 
 IFNULL(@app_nouveau_montant, 0), -- nouveau montant 
 IFNULL(@app_utilisateur, 'SYSTEM'), 
 NOW(),
 NOW() 
); 
  END$$

  DELIMITER ; */

    $current_versement = ModelVersement::where('num_versement',$this->num_versement )->first();
    $current_user = Client::where('num_compte', $current_versement->num_compte)->first();
    
    if($this->operation == 'exces'){
        $nouveau_versement_montant= (float) $current_versement->montant - (float) $this->new_montant; 
       // dd($current_user->solde);
        DB::statement("SET @app_type_action = ?", ['MODIFICATION']);
        DB::statement("SET @app_ancien_montant = ?", [$current_user->solde ?? null]);
        DB::statement("SET @app_num_compte = ?", [$current_versement->num_compte ?? null]);
        DB::statement("SET @app_nom_client = ?", [$current_user->nomclient ?? null]);
        DB::statement("SET @app_utilisateur = ?", [auth()->user()->name ?? null]);
        
        $nouveau_user_solde = $current_user->solde - $this->new_montant;
        
        DB::statement("SET @app_nouveau_montant = ?", [$nouveau_user_solde ]);
        DB::statement("SET @app_num_versement = ?", [$this->num_versement ?? null]);



        ModelVersement::where('num_versement',$this->num_versement )->update(
            ['montant' => $nouveau_versement_montant],
            );
            
            
            Client::where('num_compte', $current_versement->num_compte)->update(
                ['solde' => $nouveau_user_solde ,  ]
                );
                
                //dd($current_versement->montant,$this->new_montant,$current_versement->num_compte);
                
                }
                DB::statement("SET @app_ancien_montant = ?", [$current_user->solde ?? null]);
    if($this->operation == 'manque'){
       $nouveau_versement_solde = $current_versement->montant + $this->new_montant; 
   
        DB::statement("SET @app_type_action = ?", ['MODIFICATION']);
        DB::statement("SET @app_num_compte = ?", [$current_versement->num_compte ?? null]);
        DB::statement("SET @app_nom_client = ?", [$current_user->nomclient ?? null]);
        DB::statement("SET @app_utilisateur = ?", [auth()->user()->name ?? null]);
        $nouveau_user_solde = $current_user->solde + $this->new_montant;
        DB::statement("SET @app_nouveau_montant = ?", [$nouveau_user_solde ?? null]);
        DB::statement("SET @app_num_versement = ?", [$this->num_versement ?? null]);

       ModelVersement::where('num_versement',$this->num_versement )->update(
            ['montant' => $nouveau_versement_solde],
        );
        $current_user->solde = $nouveau_user_solde;
        $current_user->save();
    }
    if($this->operation == 'erreur'){
        $current_versement->montant = 0; 

        DB::statement("SET @app_type_action = ?", ['MODIFICATION']);
        DB::statement("SET @app_num_compte = ?", [$current_versement->num_compte ?? null]);
        DB::statement("SET @app_nom_client = ?", [$current_user->nomclient ?? null]);
        DB::statement("SET @app_utilisateur = ?", [auth()->user()->name ?? null]);
        $current_user->solde = $current_user->solde - $this->new_montant;
        DB::statement("SET @app_nouveau_montant = ?", [$current_user->solde]);
        DB::statement("SET @app_num_versement = ?", [$this->num_versement ?? null]);

        ModelVersement::where('num_versement',$this->num_versement )->update(
                ['montant' => $current_versement->montant],
            );
        $current_user->solde = $current_user->solde - $this->montant;
        $current_user->save();
    }
        return redirect()->to('/versement');
    }
    public function mount(){
      
        //dd($this->current_user);
       $this->num_compte;
       $this->num_cheque;
       $this->num_versement;
       $this->montant;
       $this->current_user;
    }
    public function delete($id){


        $versement = ModelVersement::where('num_versement',$id)->first();
        $client = Client::where('num_compte',$versement->num_compte)->first();
        
        DB::statement("SET @app_ancien_montant = ?", [$client->solde]);
        DB::statement("SET @app_type_action = ?", ['SUPPRESSION']);
        DB::statement("SET @app_num_compte = ?", [$client->num_compte ?? null]);
        DB::statement("SET @app_nom_client = ?", [$client->nomclient ?? null]);
        DB::statement("SET @app_utilisateur = ?", [auth()->user()->name ?? null]);
        DB::statement("SET @app_nouveau_montant = ?", ['0']);
        DB::statement("SET @app_num_versement = ?", [$id ?? null]);
      
    /*

            DELIMITER $$

        CREATE TRIGGER after_delete_versement
        AFTER DELETE ON versements
        FOR EACH ROW
        BEGIN
            INSERT INTO audit_versements (
                type_action,
                num_versement,
                num_compte,
                nom_client,
                ancien_montant,
                nouveau_montant,
                utilisateur,
                created_at,
                updated_at
            )
            VALUES (
                'DELETE',
                IFNULL(@app_num_versement, 'INCONNU'),
                IFNULL(@app_num_compte, 'INCONNU'),
                IFNULL(@app_nom_client, 'INCONNU'),
                IFNULL(@app_ancien_montant, 'INCONNU'),
                IFNULL(@app_nouveau_montant, 'NULL'),
                IFNULL(@app_utilisateur, 'SYSTEM'),
                NOW(),
                NOW()
            );

        END$$

        DELIMITER ;
    */
        $delete = ModelVersement::where('num_versement',$id)->delete();
     
    }
    public function render()
    {   
        $versement = Modelversement::all();
        $clients = Client::all();
        return view('livewire.versement',[
            'versements' => $versement,
            'clients' => $clients
        ]);
    }
    
}

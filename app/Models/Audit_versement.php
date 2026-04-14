<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit_versement extends Model
{
    use HasFactory;

    protected $table = 'audit_versements';


     protected $fillable = [
        'type_action',
        'date_operation',
        'num_versement',
        'num_compte',
        'nom_client',
        'ancien_montant',
        'nouveau_montant',
        'utilisateur',
    ];
}

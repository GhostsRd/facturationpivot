<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    use HasFactory;

    protected $table = 'versements';

    // Colonnes assignables en mass assignment
    protected $fillable = [
        'num_versement',
        'num_cheque',
        'num_compte',
        'montant',
    ];
}

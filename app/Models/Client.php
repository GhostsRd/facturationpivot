<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $primaryKey = 'num_compte';
    // Colonnes assignables
    protected $fillable = [
        'num_compte',
        'nomclient',
        'solde',
    ];

    // Dates traitées comme Carbon
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Exemple de relation : un client peut avoir plusieurs versements
    public function versements()
    {
        return $this->hasMany(Versement::class, 'num_compte', 'num_compte');
    }

    // Exemple de relation : un client peut avoir plusieurs audits
    public function audits()
    {
        return $this->hasMany(AuditVersement::class, 'num_compte', 'num_compte');
    }
}

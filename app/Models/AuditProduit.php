<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditProduit extends Model
{
    use HasFactory;

    protected $table = 'produits_audit';

    protected $fillable = [
        'produit_id',
        'user_name',
        'user_mail',
        'action_type',
        'tz',
        'ip',
        'user_agent',
        'referer',
    ];
}

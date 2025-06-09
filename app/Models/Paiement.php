<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'abonnement_id',
        'date_paiement',
        'montant',
        'numero_momo',
        'statut',
    ];

    public function abonnement()
    {
        return $this->belongsTo(Abonnement::class);
    }
}


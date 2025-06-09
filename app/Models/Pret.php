<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;


class Pret extends Model
{
    use HasFactory;

    protected $casts = [
    'date_pret' => 'datetime',
    'date_retour' => 'datetime',
    'date_retour_reelle' => 'datetime',
];


    protected $fillable = [
        'abonnement_id',
        'livre_id',
        'date_pret',
        'date_retour',
        'date_retour_reelle',
        'etat_retour',
        'penalite',
        'statut',
    ];

    // Un prêt appartient à un abonnement
    public function abonnement()
    {
        return $this->belongsTo(Abonnement::class);
    }

    // Un prêt concerne plusieurs livres
    public function livres()
    {
        return $this->belongsToMany(Livre::class, 'livre_pret');
    }


    // Accès direct à l’abonné via l’abonnement
    public function abonne()
    {
        return $this->hasOneThrough(Abonne::class, Abonnement::class, 'id', 'id', 'abonnement_id', 'abonne_id');
    }
    public function estEnCours()
{
    return is_null($this->date_retour_reelle);
}

public function getStatutAttribute()
{
    if ($this->date_retour_reelle) {
        return 'retourné';
    }

    if (Carbon::parse($this->date_retour)->isPast()) {
        return 'en retard';
    }

    return 'en cours';
}


}


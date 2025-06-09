<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    protected $fillable = ['abonne_id', 'bibliotheque_id', 'date_abonnement', 'date_fin', 'statut'];
    protected $dates = ['date_abonnement', 'date_fin'];

    // Mutator pour définir automatiquement la date de fin (+1 an)
    public static function boot()
    {
        parent::boot();
        static::creating(function ($abonnement) {
            $abonnement->date_abonnement = now();
            $abonnement->date_fin = now()->addYear(); // Expiration dans 1 an
            $abonnement->statut = 'Actif';
        });
    }

    // Accessor pour vérifier si l'abonnement est expiré
    public function getEstExpireAttribute()
    {
        return Carbon::parse($this->date_fin)->isPast();
    }
    public function bibliotheque()
{
    return $this->belongsTo(Bibliotheque::class, 'bibliotheque_id');
}

public function abonne()
{
    return $this->belongsTo(Abonne::class, 'abonne_id');
}

public function paiements()
{
    return $this->hasMany(Paiement::class);
}

 // Un abonnement peut avoir plusieurs prêts
    public function prets()
    {
        return $this->hasMany(Pret::class);
    }

}


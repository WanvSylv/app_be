<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livre extends Model
{
    use HasFactory;

    protected $fillable = [
        'bibliotheque_id',
        'categorie_id',
        'titre',
        'auteur',
        'annee_publication',
        'code_ISBN',
        'code_barre',
        'statut',
    ];

    // Relations
    public function bibliotheque()
    {
        return $this->belongsTo(Bibliotheque::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function prets()
    {
        return $this->belongsToMany(Pret::class, 'livre_pret');
    }

}

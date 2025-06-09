<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Bibliotheque extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ville', 'adresse'];

     public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }
}

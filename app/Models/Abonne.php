<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Abonne extends Model
{
    use HasFactory;

    protected $fillable = [
        'bibliotheque_id',
        'nom',
        'prenom',
        'adresse',
        'contact',
        'contact_urgence',
        'email',
        'statut',
        'ecole',
        'photo',
        'documents_complets',
        'compte_active',
        'date_validation',
    ];

    protected $casts = [
        'documents_complets' => 'boolean',
        'compte_active' => 'boolean',
        'date_validation' => 'datetime',
    ];

    // Activer le compte automatiquement si les documents sont complets
    public function setDocumentsCompletsAttribute($value)
    {
        $this->attributes['documents_complets'] = $value;
        if ($value) {
            $this->attributes['compte_active'] = true;
            $this->attributes['date_validation'] = now();
        } else {
            $this->attributes['compte_active'] = false;
            $this->attributes['date_validation'] = null;
        }
    }
}

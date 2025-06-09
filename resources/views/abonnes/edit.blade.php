@extends('layouts.template')

@section('title', 'Modifier un abonné')
@section('page-title', 'Modifier un abonné')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white text-center">
            <h4>Modifier un abonné</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('abonnes.update', $abonne->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ $abonne->nom }}" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénoms</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $abonne->prenom }}" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" name="adresse" id="adresse" class="form-control" value="{{ $abonne->adresse }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $abonne->email }}" required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-control" value="{{ $abonne->contact }}" required>
                </div>
                <div class="mb-3">
                    <label for="contact_urgence" class="form-label">Contact d'urgence</label>
                    <input type="text" name="contact_urgence" id="contact_urgence" class="form-control" value="{{ $abonne->contact_urgence }}" required>
                </div>
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select name="statut" id="statut" class="form-select" required>
                        <option disabled>--Veuillez choisir--</option>
                        <option value="ecolier" {{ $abonne->statut == 'ecolier' ? 'selected' : '' }}>Écolier</option>
                        <option value="eleve" {{ $abonne->statut == 'eleve' ? 'selected' : '' }}>Élève</option>
                        <option value="etudiant" {{ $abonne->statut == 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                        <option value="professionnel" {{ $abonne->statut == 'professionnel' ? 'selected' : '' }}>Professionnel</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ecole" class="form-label">École ou Université</label>
                    <input type="text" name="ecole" id="ecole" class="form-control" value="{{ $abonne->ecole }}">
                </div>
                <div class="form-group">
                    <label for="photo">Photo (optionnelle)</label>
                    <div id="drop-area" class="border p-3 text-center">
                        <p>Glissez-déposez une image ici ou cliquez pour en sélectionner une.</p>
                        <input type="file" id="photo" name="photo" class="d-none">
                    </div>
                    @if ($abonne->photo)
                    <img id="preview" class="mt-2" src="{{ asset('storage/' . $abonne->photo) }}" style="max-width: 150px;">
                    @else
                    <img id="preview" class="mt-2" style="max-width: 150px; display: none;">
                    @endif
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="documents_complets" id="documents_complets" class="form-check-input" {{ $abonne->documents_complets ? 'checked' : '' }}>
                    <label for="documents_complets" class="form-check-label">Dossier complet</label>
                </div>
                {{-- <div class="mb-3 form-check">
                    <input type="checkbox" name="compte_active" id="compte_active" class="form-check-input" {{ $abonne->compte_active ? 'checked' : '' }}>
                    <label for="compte_active" class="form-check-label">Compte activé</label>
                </div> --}}
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('abonnes.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection

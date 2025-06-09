@extends('layouts.template')
@section('title', 'Livre')
@section('page-title', ' Modifier livre')

@section('content')
<div class="container mt-4">
    <div class="card">
 <div class="card-header bg-info text-white text-center">
     <h4>Modifier le livre</h4>
 </div>
        
<div class="card-body">
  <form action="{{ route('livres.update', $livre->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="bibliotheque_id">Bibliothèque</label>
            <select name="bibliotheque_id" id="bibliotheque_id" class="form-control" required>
                @foreach($bibliotheques as $bibliotheque)
                <option value="{{ $bibliotheque->id }}" {{ $livre->bibliotheque_id == $bibliotheque->id ? 'selected' : '' }}>
                    {{ $bibliotheque->nom }} {{ $bibliotheque->ville }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="categorie_id">Catégorie</label>
            <select name="categorie_id" id="categorie_id" class="form-control" required>
                @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}" {{ $livre->categorie_id == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->nom }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ $livre->titre }}" required>
        </div>
        <div class="form-group">
            <label for="auteur">Auteur</label>
            <input type="text" name="auteur" id="auteur" class="form-control" value="{{ $livre->auteur }}" required>
        </div>
        <div class="form-group">
            <label for="annee_publication">Année de Publication</label>
            <input type="number" name="annee_publication" id="annee_publication" class="form-control" value="{{ $livre->annee_publication }}" required>
        </div>
        <div class="form-group">
            <label for="code_ISBN">Code ISBN</label>
            <input type="text" name="code_ISBN" id="code_ISBN" class="form-control" value="{{ $livre->code_ISBN }}" required>
        </div>
        <div class="form-group">
            <label for="code_barre">Code Barre</label>
            <input type="text" name="code_barre" id="code_barre" class="form-control" value="{{ $livre->code_barre }}" required>
        </div>
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control" required>
                <option value="disponible" {{ $livre->statut == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="emprunté" {{ $livre->statut == 'emprunté' ? 'selected' : '' }}>Emprunté</option>
                <option value="réservé" {{ $livre->statut == 'réservé' ? 'selected' : '' }}>Réservé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Modifier</button>
    </form>
</div>
 </div>
</div>
@endsection

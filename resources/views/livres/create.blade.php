@extends('layouts.template')

@section('title', 'livre')
@section('page-title', ' Ajout livre')

@section('content')

    
 <div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white text-center">
            <h4>Ajouter un livre</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('livres.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="bibliotheque_id">Bibliothèque</label>
                    <select name="bibliotheque_id" id="bibliotheque_id" class="form-control" required>
                        <option value="">-- Sélectionnez --</option>
                        @foreach($bibliotheques as $bibliotheque)
                        <option value="{{ $bibliotheque->id }}">{{ $bibliotheque->nom }} {{ $bibliotheque->ville }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="categorie_id">Catégorie</label>
                    <select name="categorie_id" id="categorie_id" class="form-control" required>
                        <option value="">-- Sélectionnez --</option>
                        @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" name="titre" id="titre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="auteur">Auteur</label>
                    <input type="text" name="auteur" id="auteur" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="annee_publication">Année de Publication</label>
                    <input type="number" name="annee_publication" id="annee_publication" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="code_ISBN">Code ISBN</label>
                    <input type="text" name="code_ISBN" id="code_ISBN" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="code_barre">Code Barre</label>
                    <input type="text" name="code_barre" id="code_barre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select name="statut" id="statut" class="form-control" required>
                        <option value="disponible">Disponible</option>
                        <option value="emprunté">Emprunté</option>
                        <option value="réservé">Réservé</option>
                    </select>
                </div><br>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
</div>
    </div>
</div>
</div>

@endsection

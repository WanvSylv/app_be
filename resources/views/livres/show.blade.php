@extends('layouts.template')

@section('title', 'livre')
@section('page-title', ' détail sur le livre')

@section('content')
<div class="container">
    <div class="card">
       <div class="card-header bg-info text-white text-center">
        <h4>Détails du Livre</h4>
    </div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item"><strong>Titre :</strong> {{ $livre->titre }}</li>
            <li class="list-group-item"><strong>Auteur :</strong> {{ $livre->auteur }}</li>
            <li class="list-group-item"><strong>Année de Publication :</strong> {{ $livre->annee_publication }}</li>
            <li class="list-group-item"><strong>ISBN :</strong> {{ $livre->code_ISBN }}</li>
            <li class="list-group-item"><strong>Code Barre :</strong> {{ $livre->code_barre }}</li>
            <li class="list-group-item"><strong>Statut :</strong> {{ ucfirst($livre->statut) }}</li>
            <li class="list-group-item"><strong>Bibliothèque :</strong> {{ $livre->bibliotheque->nom }}</li>
            <li class="list-group-item"><strong>Catégorie :</strong> {{ $livre->categorie->nom }}</li>
        </ul>
        <a href="{{ route('livres.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
    </div>
      
    </div>
   
   
   
</div>
@endsection

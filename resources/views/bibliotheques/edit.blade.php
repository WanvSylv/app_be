@extends('layouts.template')
@section('title', 'Bibliotheque')
@section('page-title', ' Modifier bibliothèque')

@section('content')
<div class="container mt-4">
    <div class="card">
 <div class="card-header bg-info text-white text-center">
     <h4>Modifier la Bibliothèque</h4>
 </div>
        
<div class="card-body">
  <form action="{{ route('bibliotheques.update', $bibliotheque->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $bibliotheque->nom }}" required>
        </div>

        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" name="ville" id="ville" class="form-control" value="{{ $bibliotheque->ville }}" required>
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <textarea name="adresse" id="adresse" class="form-control" rows="3" required>{{ $bibliotheque->adresse }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Modifier</button>
        <a href="{{ route('bibliotheques.index') }}" class="btn btn-secondary">Annuler</a>
    </form>

</div>
 </div>
</div>
@endsection

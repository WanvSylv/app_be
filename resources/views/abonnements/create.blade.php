@extends('layouts.template')

@section('title', 'Ajouter un abonnement')
@section('page-title', 'Ajouter un abonnement')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-info text-white text-center">
            <h4>Nouvel abonnement</h4>
        </div>
        <div class="card-body">
            
                   
                <form action="{{ route('abonnements.store') }}" method="POST">
                    @csrf
            
                    <div class="mb-3">
                        <label>Abonné</label>
                        <select name="abonne_id" class="form-control" required>
                            <option value="">Sélectionner un abonné</option>
                            @foreach($abonnes as $abonne)
                                <option value="{{ $abonne->id }}">{{ $abonne->nom }} {{ $abonne->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label>Bibliothèque</label>
                        <select name="bibliotheque_id" class="form-control" required>
                            <option value="">Sélectionner une bibliothèque</option>
                            @foreach($bibliotheques as $bibliotheque)
                                <option value="{{ $bibliotheque->id }}">{{ $bibliotheque->nom }} {{ $bibliotheque->ville }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label>Date d'abonnement</label>
                        <input type="date" name="date_abonnement" class="form-control" required>
                    </div>
            
                    <button type="submit" class="btn btn-primary btn-lage">Créer</button>
                </form>
           
        </div>
    </div>
   
</div>
@endsection

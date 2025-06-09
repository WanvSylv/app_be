@extends('layouts.template')

@section('title', 'Modifier un abonné')
@section('page-title', 'Modifier un abonné')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-info text-white text-center">
            <h4>Modifier l'abonnement</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('abonnements.update', $abonnement->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Abonné</label>
                    <select name="abonne_id" class="form-control">
                        @foreach($abonnes as $abonne)
                        <option value="{{ $abonne->id }}" {{ $abonne->id == $abonnement->abonne_id ? 'selected' : '' }}>
                            {{ $abonne->nom }} {{ $abonne->prenom }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Bibliothèque</label>
                    <select name="bibliotheque_id" class="form-control">
                        @foreach($bibliotheques as $bibliotheque)
                        <option value="{{ $bibliotheque->id }}" {{ $bibliotheque->id == $abonnement->bibliotheque_id ? 'selected' : '' }}>
                            {{ $bibliotheque->nom }} - {{ $bibliotheque->ville }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Date d'abonnement</label>
                    <input type="date" name="date_abonnement" class="form-control" value="{{ old('date_abonnement', $abonnement->date_abonnement) }}">
                </div>

                <button type="submit" class="btn btn-success">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
@endsection

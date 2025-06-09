@extends('layouts.template')

@section('title', 'Détails de l\'abonné')
@section('page-title', 'Détails de l\'abonné')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-gradient-info text-white text-center py-3">
            <h4 class="mb-0">Détails de l'abonné</h4>
        </div>
        <div class="card-body p-5">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($abonne->photo)
                        <img src="{{ asset('storage/' . $abonne->photo) }}" alt="Photo de l'abonné" class="img-fluid rounded-circle shadow-lg" style="max-width: 180px; max-height: 180px;">
                    @else
                        <img src="{{ asset('storage/default-avatar.png') }}" alt="Avatar par défaut" class="img-fluid rounded-circle shadow-lg" style="max-width: 180px; max-height: 180px;">
                    @endif
                    <h5 class="mt-3">{{ $abonne->nom }} {{ $abonne->prenom }}</h5>
                    <p class="text-muted">{{ $abonne->ecole ?? 'École ou université non spécifiée' }}</p>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <p class="font-weight-bold">Adresse:</p>
                            <p>{{ $abonne->adresse ?? 'Non spécifiée' }}</p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="font-weight-bold">Email:</p>
                            <p>{{ $abonne->email ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="font-weight-bold">Contact:</p>
                            <p>{{ $abonne->contact ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="font-weight-bold">Contact d'urgence:</p>
                            <p>{{ $abonne->contact_urgence ?? 'Non spécifié' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <p class="font-weight-bold">Statut:</p>
                            @if($abonne->statut)
                                <span class="badge badge-primary">{{ ucfirst($abonne->statut) }}</span>
                            @else
                                <span class="badge badge-secondary">Non spécifié</span>
                            @endif
                        </div>

                        <div class="col-6 mb-3">
                            <p class="font-weight-bold">Dossier complet:</p>
                            @if($abonne->documents_complets)
                                <span class="badge badge-success">Oui</span>
                            @else
                                <span class="badge badge-danger">Non</span>
                            @endif
                        </div>

                        <div class="col-6 mb-3">
                            <p class="font-weight-bold">Compte activé:</p>
                            @if($abonne->compte_active)
                                <span class="badge badge-success">Oui</span>
                            @else
                                <span class="badge badge-warning">Non</span>
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('abonnes.index') }}" class="btn btn-outline-secondary btn-lg mt-3 w-100">Retour à la liste</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

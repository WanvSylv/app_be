@extends('layouts.template')

@section('title', 'Abonnements Actifs')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-success mb-0">
            <i class="fas fa-check-circle me-2"></i>Abonnements Actifs
        </h4>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Retour au tableau de bord
        </a>
    </div>

    @if($abonnements->isEmpty())
        <div class="alert alert-info text-center">
            Aucun abonnement actif pour le moment.
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0 align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Téléphone</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($abonnements as $index => $abonnement)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $abonnement->abonne->nom }}</td>
                                    <td>{{ $abonnement->abonne->prenom }}</td>
                                    <td>{{ $abonnement->abonne->telephone ?? '—' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($abonnement->date_debut)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($abonnement->date_fin)->format('d/m/Y') }}</td>
                                    <td><span class="badge bg-success">Actif</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

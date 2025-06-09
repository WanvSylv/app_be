@extends('layouts.template')

@section('title', 'Liste des abonnements')
@section('page-title', 'Liste des abonnements')

@section('content')
<div class="container py-4">

    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0"><i class="fas fa-book-reader me-2"></i>Gestion des abonnements</h4>
        </div>
        
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('abonnements.create') }}" class="btn btn-success">
                    <i class="fas fa-plus-circle me-1"></i> Ajouter un abonnement
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle" id="zero_config">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Abonné</th>
                            <th>Bibliothèque</th>
                            <th>Date d'abonnement</th>
                            <th>Date d'expiration</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abonnements as $abonnement)
                        <tr>
                            <td>
                                {{ optional($abonnement->abonne)->nom }} {{ optional($abonnement->abonne)->prenom }}
                            </td>
                            <td>{{ $abonnement->bibliotheque->nom }} - {{ $abonnement->bibliotheque->ville }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($abonnement->date_abonnement)->format('d/m/Y') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($abonnement->date_fin)->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-{{ $abonnement->est_expire ? 'danger' : 'success' }}">
                                    {{ $abonnement->est_expire ? 'Expiré' : 'Actif' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('abonnements.edit', $abonnement->id) }}" class="btn btn-warning btn-sm mb-1" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    @if(!$abonnement->est_expire)
                                        <a href="{{ route('abonnements.carte', $abonnement->abonne->id) }}" class="btn btn-success btn-sm mb-1" title="Voir la carte">
                                            <i class="fas fa-id-card"></i>
                                        </a>
                                    @endif

                                    @if($abonnement->est_expire)
                                        <a href="{{ route('abonnements.renouveler', $abonnement->id) }}" class="btn btn-primary btn-sm mb-1" title="Renouveler l'abonnement">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                    @endif

                                    <!-- Button trigger modal -->
                                    <button class="btn btn-danger btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $abonnement->id }}" title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    
                                    <!-- Modal de confirmation de suppression -->
                                    <div class="modal fade" id="deleteModal{{ $abonnement->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $abonnement->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $abonnement->id }}">Confirmer la suppression</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cet abonnement pour <strong>{{ optional($abonnement->abonne)->nom }} {{ optional($abonnement->abonne)->prenom }}</strong> ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('abonnements.destroy', $abonnement->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- table-responsive -->
        </div>
    </div>
</div>
@endsection


@extends('layouts.template')

@section('title', 'Bibliothèque')
@section('page-title', 'Liste des bibliothèques')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-info text-white text-center">
            <h4>Liste des livres</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('livres.create') }}" class="btn btn-primary rounded-pill btn-sm">
                    <i class="fa fa-plus me-2"></i> Ajouter un Livre
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle" id="zero_config">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Année</th>
                            <th>ISBN</th>
                            <th>Code Barre</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($livres as $livre)
                        <tr>
                            <td>{{ $livre->id }}</td>
                            <td>{{ $livre->titre }}</td>
                            <td>{{ $livre->auteur }}</td>
                            <td>{{ $livre->annee_publication }}</td>
                            <td>{{ $livre->code_ISBN }}</td>
                            <td>{{ $livre->code_barre }}</td>
                            <td>
                                <span class="badge rounded-pill bg-{{ $livre->statut == 'disponible' ? 'success' : 'danger' }}">
                                    {{ ucfirst($livre->statut) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('livres.show', $livre->id) }}" class="btn btn-info btn-sm" title="Voir">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('livres.edit', $livre->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <!-- Button trigger modal -->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $livre->id }}" title="Supprimer">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <!-- Modal de confirmation de suppression -->
                                    <div class="modal fade" id="deleteModal{{ $livre->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $livre->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $livre->id }}">Confirmer la suppression</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer ce livre intitulé <strong>{{ $livre->titre }}</strong> ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="d-inline">
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

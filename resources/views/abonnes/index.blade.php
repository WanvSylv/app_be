@extends('layouts.template')

@section('title', 'Liste des abonnés')
@section('page-title', 'Liste des abonnés')

@section('content')
<div class="container mt-4">
    <div class="card">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Liste des abonnés</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('abonnes.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-user-plus"></i> Ajouter un abonné
            </a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle" id="zero_config">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénoms</th>
                            <th>Adresse</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Urgence</th>
                            <th>Statut</th>
                            <th>École / Université</th>
                            <th>Photo</th>
                            <th>Dossier complet?</th>
                            <th>Statut du compte</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abonnes as $abonne)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $abonne->nom }}</td>
                                <td>{{ $abonne->prenom }}</td>
                                <td>{{ $abonne->adresse }}</td>
                                <td>{{ $abonne->email }}</td>
                                <td>{{ $abonne->contact }}</td>
                                <td>{{ $abonne->contact_urgence }}</td>
                                <td>
                                    <span class="badge bg-{{ $abonne->statut == 'actif' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($abonne->statut) }}
                                    </span>
                                </td>
                                <td>{{ $abonne->ecole }}</td>
                                <td>
                                    @if($abonne->photo)
                                        <img src="{{ asset('storage/' . $abonne->photo) }}" alt="Photo" class="img-thumbnail" style="max-width: 80px;">
                                    @else
                                        <span class="text-muted">Aucune</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $abonne->documents_complets ? 'success' : 'danger' }}">
                                        {{ $abonne->documents_complets ? 'Oui' : 'Non' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $abonne->compte_active ? 'success' : 'danger' }}">
                                        {{ $abonne->compte_active ? 'Activé' : 'Désactivé' }}
                                    </span>
                                    @if($abonne->documents_complets && !$abonne->compte_active)
                                        <form action="{{ route('abonnes.activer', $abonne->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success mt-1">Activer</button>
                                        </form>
                                    @endif
                                </td>
                                
                                <td class="text-nowrap">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('abonnes.show', $abonne->id) }}" class="btn btn-info btn-sm" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('abonnes.edit', $abonne->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $abonne->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>

                                    {{-- Modal de confirmation de suppression --}}
                                    <div class="modal fade" id="deleteModal{{ $abonne->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $abonne->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $abonne->id }}">Confirmer la suppression</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cet abonné <strong>{{ $abonne->prenom }} {{ $abonne->nom }}</strong> ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('abonnes.destroy', $abonne->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $abonnes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".activate-account").forEach(button => {
            button.addEventListener("click", function () {
                let abonneId = this.getAttribute("data-id");
                if (confirm("Voulez-vous vraiment activer ce compte ?")) {
                    fetch(`/abonnes/${abonneId}/activate`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({}) 
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Compte activé avec succès !");
                            location.reload();
                        } else {
                            alert("Une erreur est survenue.");
                        }
                    });
                }
            });
        });
    });
</script>

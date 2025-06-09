@extends('layouts.template')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📚 Liste des prêts</h4>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Abonné</th>
                            <th>Livre</th>
                            <th>Date prêt</th>
                            <th>Date retour prévue</th>
                            <th>Date retour réelle</th>
                            <th>État retour</th>
                            <th>Statut</th>
                            <th>Pénalité (FCFA)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prets as $pret)
                            <tr>
                                <td>{{ $pret->abonnement->abonne->nom }} {{ $pret->abonnement->abonne->prenom }}</td>
                                 <td>
                                    @foreach ($pret->livres as $livre)
                                        <span class="badge bg-primary">{{ $livre->titre }}</span><br>
                                    @endforeach
                                </td>
                                <td>{{ $pret->date_pret->format('d/m/Y') }}</td>
                                <td>{{ $pret->date_retour->format('d/m/Y') }}</td>
                                <td>{{ $pret->date_retour_reelle ? $pret->date_retour_reelle->format('d/m/Y') : '-' }}</td>
                                <td>{{ $pret->etat_retour ?? '-' }}</td>
                                <td>
                                    @if($pret->statut == 'en retard')
                                        <span class="badge bg-danger">En retard</span>
                                    @elseif($pret->statut == 'retourné')
                                        <span class="badge bg-success">Retourné</span>
                                    @else
                                        <span class="badge bg-warning text-dark">En cours</span>
                                    @endif
                                </td>
                                <td>{{ number_format($pret->penalite, 0, ',', ' ') }}</td>
                                <td class="d-flex gap-1">
                                    @if($pret->estEnCours())
                                        <a href="{{ route('prets.edit', $pret->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-arrow-return-left"></i> Retour
                                        </a>
                                    @endif
                                    <form action="{{ route('prets.destroy', $pret->id) }}" method="POST" onsubmit="return confirm('Supprimer ce prêt ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($prets->isEmpty())
                            <tr>
                                <td colspan="9" class="text-center text-muted">Aucun prêt enregistré.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



@extends('layouts.template')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Enregistrement d’un Nouveau Prêt</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('prets.store') }}" method="POST">
                @csrf

                {{-- Sélection de l’abonnement --}}
                <div class="mb-3">
                    <label for="abonnement_id" class="form-label">Abonné avec abonnement actif</label>
                    <select name="abonnement_id" id="abonnement_id" class="form-select" required>
                        <option value="">-- Choisir un abonné --</option>
                        @foreach ($abonnements as $abonnement)
                            <option value="{{ $abonnement->id }}">
                                {{ $abonnement->abonne->nom }} {{ $abonnement->abonne->prenom }}
                                (Début : {{ $abonnement->created_at->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Sélection du livre --}}
                <div class="mb-3">
                    <label for="livres" class="form-label">Livres à prêter</label>
                    <select name="livre_id[]" id="livres" class="form-select select2" multiple="multiple" required>
                     @foreach ($livres as $livre)
                        @php
                            $estDejaPret = $livre->prets()->where('statut', 'en cours')->exists();
                        @endphp
                        <option value="{{ $livre->id }}" {{ $estDejaPret ? 'disabled' : '' }}>
                            {{ $livre->titre }} ({{ $livre->auteur }}) {{ $estDejaPret ? ' - Déjà prêté' : '' }}
                        </option>
                    @endforeach

                    </select>
                </div>


                {{-- Dates du prêt --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date_pret" class="form-label">Date du prêt</label>
                        <input type="date" name="date_pret" id="date_pret" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="date_retour" class="form-label">Date de retour prévue</label>
                        <input type="date" name="date_retour" id="date_retour" class="form-control" required>
                    </div>
                </div>

                {{-- Zone d’alerte (optionnelle) --}}
                <div class="alert alert-info">
                    <strong>Note :</strong> Le retour doit être effectué avant la date prévue. En cas de retard ou d’état dégradé du livre, une pénalité sera appliquée.
                </div>

                {{-- Boutons --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('prets.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Enregistrer le prêt</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


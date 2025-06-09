@extends('layouts.template')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <h4 class="mb-0"><i class="bi bi-journal-arrow-up me-2"></i>Retour du Livre</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('prets.retourner', $pret->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">📘 Livre</label>
                        @foreach ($pret->livres as $livre)
                            <input type="text" class="form-control mb-2" value="{{ $livre->titre }}" disabled>
                        @endforeach

                    </div>
                    <div class="col-md-6">
                        <label class="form-label">👤 Abonné</label>
                        <input type="text" class="form-control" value="{{ $pret->abonnement->abonne->nom }} {{ $pret->abonnement->abonne->prenom }}" disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date_retour_reel" class="form-label">📅 Date de retour réelle</label>
                        <input type="date" name="date_retour_reel" id="date_retour_reel" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="etat_livre_retour" class="form-label">📝 État du livre au retour</label>
                        <select name="etat_livre_retour" id="etat_livre_retour" class="form-select" required>
                            <option value="">-- Sélectionner l'état --</option>
                            <option value="bon">Bon</option>
                            <option value="endommagé">Endommagé</option>
                            <option value="perdu">Perdu</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('prets.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-x-circle"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Valider le retour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



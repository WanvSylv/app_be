@extends('layout.template')

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Modifier mon profil</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $user->nom) }}" required>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $user->prenom) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="tel" class="form-label">Téléphone</label>
                    <input type="text" name="tel" class="form-control" value="{{ old('tel', $user->tel) }}">
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('profile.show') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection


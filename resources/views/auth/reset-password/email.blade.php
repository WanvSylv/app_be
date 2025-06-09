@extends('layouts.template')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('status'))
                <div class="alert alert-success text-center">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card shadow rounded">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Réinitialisation du mot de passe</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted text-center">
                        Entrez votre adresse e-mail pour recevoir un lien de réinitialisation.
                    </p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email">Adresse e-mail</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required autofocus value="{{ old('email') }}">
                            
                            @error('email')
                                <span class="invalid-feedback d-block mt-1" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Envoyer le lien de réinitialisation
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}">Retour à la connexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

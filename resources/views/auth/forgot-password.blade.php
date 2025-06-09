@extends('layouts.template')
@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
        <div class="auth-box p-4 bg-white rounded">
            <div>
                <div class="logo text-center">
                    <span class="db"><img alt="thumbnail" class="rounded-circle" width="80" src="../assets/images/users/1.jpg"></span>
                    <h5 class="font-weight-medium mb-3">Réinitialisation du mot de passe</h5>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                           <!-- Affichage des messages de succès -->
                           @if (session('status'))
                                <div class="alert alert-success mt-3">
                                    {{ session('status') }}
                                </div>
                            @endif
                        <form class="form-horizontal mt-3" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3 row">
                                <div class="col-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Adresse e-mail">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="col-xs-12">
                                    <button class="btn d-block w-100 btn-info" type="submit">Envoyer le lien de réinitialisation</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


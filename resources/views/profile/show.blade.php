@extends('layout.template') 

@section('content')
<div class="container mt-5">
    <div class="card shadow rounded">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Mon Profil</h4>
            <a href="{{ route('profile.edit') }}" class="btn btn-light btn-sm">Modifier mon profil</a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Nom :</label>
                <div class="col-sm-9">{{ $user->nom }}</div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Prénom :</label>
                <div class="col-sm-9">{{ $user->prenom }}</div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Email :</label>
                <div class="col-sm-9">{{ $user->email }}</div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 fw-bold">Téléphone :</label>
                <div class="col-sm-9">{{ $user->tel }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

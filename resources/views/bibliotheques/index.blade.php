@extends('layouts.template')

@section('title', 'Bibliotheque')
@section('page-title', ' Liste des bibliothèques')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white text-center">
            <h4>Liste des Bibliothèques</h4>
        </div>
        <div class="card-body">
    <a href="{{ route('bibliotheques.create') }}" class="btn btn-primary mb-3 rounded-pill btn-sm"><i class="fa fa-plus"></i> Ajouter une Bibliothèque</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Ville</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bibliotheques as $bibliotheque)
                <tr>
                    <td>{{ $bibliotheque->id }}</td>
                    <td>{{ $bibliotheque->nom }}</td>
                    <td>{{ $bibliotheque->ville }}</td>
                    <td>{{ $bibliotheque->adresse }}</td>
                    <td>
                        <a href="{{ route('bibliotheques.edit', $bibliotheque->id) }}" class="btn btn-warning rounded-pill btn-sm"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('bibliotheques.destroy', $bibliotheque->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
    
</div>
@endsection
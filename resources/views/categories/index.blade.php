@extends('layouts.template')

@section('title', 'Catégories')
@section('page-title', 'Liste des catégories')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white text-center">
            <h4>Liste des Catégories</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3 rounded-pill btn-sm">
                <i class="fa fa-plus"></i> Ajouter une Catégorie
            </a>
            <table class="table table-bordered table-striped" id='zero_config'>
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->nom }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning rounded-pill btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Êtes-vous sûr ?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
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

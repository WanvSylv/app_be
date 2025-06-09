@extends('layouts.template')

@section('title', 'Modifier Catégorie')
@section('page-title', 'Modifier une catégorie')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white text-center">
            <h4>Modifier une Catégorie</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ $category->nom }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ $category->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-warning">Modifier</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection

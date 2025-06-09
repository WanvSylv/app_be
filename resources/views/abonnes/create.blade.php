@extends('layouts.template')

@section('title', 'Ajouter un abonné')
@section('page-title', 'Ajouter un abonné')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white text-center">
            <h4>Ajouter un abonné</h4>
        </div>
    
            <div class="card-body">
                <!-- Affichage des messages d'erreur -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <form action="{{ route('abonnes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="bibliotheque_id" class="form-label">Bibliothèque</label>
                    <select name="bibliotheque_id" id="bibliotheque_id" class="form-select" required>
                        <option disabled selected>--Veuillez choisir--</option>
                        @foreach ($bibliotheques as $bibliotheque)
                            <option value="{{ $bibliotheque->id }}">
                                {{ $bibliotheque->nom }} - {{ $bibliotheque->ville }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénoms</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" name="adresse" id="adresse" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" name="contact" id="contact" class="form-control" required pattern="[0-9]{10}" title="Entrez un numéro à 10 chiffres">
                </div>
                <div class="mb-3">
                    <label for="contact_urgence" class="form-label">Contact d'urgence</label>
                    <input type="text" name="contact_urgence" id="contact_urgence" class="form-control" required pattern="[0-9]{10}" title="Entrez un numéro à 10 chiffres">
                </div>
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select name="statut" id="statut" class="form-select" required>
                        <option disabled selected>--Veuillez choisir--</option>
                        <option value="ecolier">Écolier</option>
                        <option value="eleve">Élève</option>
                        <option value="etudiant">Étudiant</option>
                        <option value="professionnel">Professionnel</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ecole" class="form-label">École ou Université</label>
                    <input type="text" name="ecole" id="ecole" class="form-control" placeholder="NB:Ignorer ce champ si le statut est profesionel">
                </div>
                <div class="form-group">
                    <label for="photo">Photo (optionnelle)</label>
                    <div id="drop-area" class="border p-3 text-center">
                        <p>Glissez-déposez une image ici ou cliquez pour en sélectionner une.</p>
                        <input type="file" id="photo" name="photo" class="d-none">
                    </div>
                    <img id="preview" class="mt-2" style="max-width: 150px; display: none;">
                </div>
                <div class="form-check form-switch mb-3">
                    <input type="hidden" name="documents_complets" value="0">
                    <input class="form-check-input" type="checkbox" id="documents_complets" name="documents_complets" value="1" {{ old('documents_complets') ? 'checked' : '' }}>
                    <label class="form-check-label" for="documents_complets">Documents complets</label>
                </div>
                
                {{-- <div class="form-check form-switch mb-3">
                    <input type="hidden" name="compte_active" value="0">
                    <input class="form-check-input" type="checkbox" id="compte_active" name="compte_active" value="1" {{ old('compte_active') ? 'checked' : '' }}>
                    <label class="form-check-label" for="compte_active">Compte actif</label>
                </div> --}} 
                
                <button type="submit" class="btn btn-success">Enregistrer</button>
                <a href="{{ route('abonnes.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let dropArea = document.getElementById("drop-area");
        let inputFile = document.getElementById("photo");
        let preview = document.getElementById("preview");
    
        dropArea.addEventListener("dragover", function (e) {
            e.preventDefault();
            dropArea.classList.add("border-primary");
        });
    
        dropArea.addEventListener("dragleave", function () {
            dropArea.classList.remove("border-primary");
        });
    
        dropArea.addEventListener("drop", function (e) {
            e.preventDefault();
            dropArea.classList.remove("border-primary");
    
            let file = e.dataTransfer.files[0];
            inputFile.files = e.dataTransfer.files;
    
            previewImage(file);
        });
    
        dropArea.addEventListener("click", function () {
            inputFile.click();
        });
    
        inputFile.addEventListener("change", function () {
            let file = inputFile.files[0];
            previewImage(file);
        });
    
        function previewImage(file) {
            if (file && file.type.startsWith("image/")) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        }
    });
    </script>
    

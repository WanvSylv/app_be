<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bibliotheque_id')->constrained('bibliotheques')->onDelete('cascade');
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->string('titre');
            $table->string('auteur');
            $table->year('annee_publication');
            $table->string('code_ISBN')->unique();
            $table->string('code_barre')->unique();
            $table->enum('statut', ['disponible', 'emprunté', 'réservé'])->default('disponible');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('livres');
    }
};

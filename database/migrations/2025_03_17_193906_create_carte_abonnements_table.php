<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
      Schema::create('cartes_abonnements', function (Blueprint $table) {
                $table->id();
                $table->foreignId('abonne_id')->constrained('abonnes')->onDelete('cascade');
                $table->foreignId('bibliotheque_id')->constrained('bibliotheques')->onDelete('cascade');
                $table->string('nom');
                $table->string('prenom');
                $table->string('adresse')->nullable();
                $table->string('contact');
                $table->string('photo')->nullable();
                $table->string('qr_code_path');
                $table->string('logo_path')->nullable();
                $table->string('numero_abonnement')->unique();
                $table->date('date_abonnement');
                $table->date('date_expiration');
                $table->timestamps();
        });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carte_abonnements');
    }
};

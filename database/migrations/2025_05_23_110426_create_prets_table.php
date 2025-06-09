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
    Schema::create('prets', function (Blueprint $table) {
        $table->id();
    $table->foreignId('abonnement_id')->constrained()->onDelete('cascade');
    $table->foreignId('livre_id')->constrained()->onDelete('cascade');
    $table->date('date_pret');
    $table->date('date_retour');
    $table->date('date_retour_reelle')->nullable();
    $table->string('etat_retour')->nullable(); // bon, abîmé, perdu
    $table->decimal('penalite', 8, 2)->default(0);
   $table->enum('statut', ['en cours', 'retourné', 'en retard'])->default('en cours');
    $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prets');
    }
};

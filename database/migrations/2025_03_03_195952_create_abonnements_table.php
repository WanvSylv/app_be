<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('abonnements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('abonne_id')->constrained('abonnes')->onDelete('cascade');
            $table->foreignId('bibliotheque_id')->constrained('bibliotheques')->onDelete('cascade');
            $table->date('date_abonnement');
            $table->date('date_fin');
            $table->enum('statut', ['actif', 'expiré'])->default('actif');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnements');
    }
};

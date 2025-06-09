<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('abonnement_id')->constrained()->onDelete('cascade');
            $table->date('date_paiement');
            $table->integer('montant'); // montant payé
            $table->string('numero_momo'); // numéro de paiement Mobile Money
            $table->enum('statut', ['réussi', 'échoué', 'en attente'])->default('en attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};

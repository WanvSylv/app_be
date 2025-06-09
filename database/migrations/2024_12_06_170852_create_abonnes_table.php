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
        Schema::create('abonnes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bibliotheque_id')->constrained('bibliotheques')->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse')->nullable();
            $table->string('contact');
            $table->string('contact_urgence');
            $table->string('email')->unique();
            $table->string('statut');
            $table->string('ecole')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('documents_complets')->default(false);
            $table->boolean('compte_active')->default(false);
            $table->timestamp('date_validation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abonnes');
    }
};

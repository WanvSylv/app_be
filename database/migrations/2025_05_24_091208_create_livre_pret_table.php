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
        Schema::create('livre_pret', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pret_id')->constrained()->onDelete('cascade');
        $table->foreignId('livre_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livre_pret');
    }
};

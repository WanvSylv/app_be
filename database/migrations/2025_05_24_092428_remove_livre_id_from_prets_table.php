<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::table('prets', function (Blueprint $table) {
        $table->dropForeign(['livre_id']); // si la clé étrangère existe
        $table->dropColumn('livre_id');
    });
}

public function down()
{
    Schema::table('prets', function (Blueprint $table) {
        $table->foreignId('livre_id')->constrained()->onDelete('cascade');
    });
}

};

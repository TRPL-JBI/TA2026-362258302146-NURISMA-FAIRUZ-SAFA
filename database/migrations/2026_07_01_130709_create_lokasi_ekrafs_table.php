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
    Schema::create('lokasi_ekraf', function (Blueprint $table) {

        $table->id('id_lokasi');

        $table->foreignId('id_ekraf')
              ->constrained('pelaku_ekraf', 'id_ekraf')
              ->cascadeOnDelete();

        $table->decimal('latitude', 10, 7);

        $table->decimal('longitude', 10, 7);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::dropIfExists('lokasi_ekraf');
}
};
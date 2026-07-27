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
       Schema::create('pelaku_ekraf', function (Blueprint $table) {

    $table->id('id_ekraf');

    $table->foreignId('id_user')
          ->constrained('users','id_user')
          ->cascadeOnDelete();

    $table->foreignId('id_subsektor')
          ->constrained('subsektor_ekraf','id_subsektor');

    $table->foreignId('id_wilayah')
          ->constrained('wilayah','id_wilayah');

    $table->string('nama_perusahaan');

    $table->string('nama_proyek');

    $table->text('alamat');

    $table->string('nomor_telp');

    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::dropIfExists('pelaku_ekraf');
}
};

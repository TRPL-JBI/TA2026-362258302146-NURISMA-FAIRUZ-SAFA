<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
public function up(): void
{
    Schema::create('verifikasi', function (Blueprint $table) {

    $table->id('id_verifikasi');

    $table->foreignId('id_user')
          ->constrained('users','id_user')
          ->cascadeOnDelete();
          
$table->enum('jenis_pengajuan', [
    'pendaftaran_baru',
    'perubahan_data'
])->default('pendaftaran_baru');

    $table->string('nama_perusahaan');

    $table->string('nama_proyek');

    $table->text('alamat');

    $table->foreignId('id_subsektor')
          ->constrained('subsektor_ekraf','id_subsektor');

    $table->foreignId('id_wilayah')
          ->constrained('wilayah','id_wilayah');

    $table->string('nomor_telp');

    $table->enum('status_verifikasi',[
        'menunggu',
        'disetujui',
        'ditolak'
    ])->default('menunggu');

    $table->text('catatan')->nullable();

    $table->timestamp('tanggal_verifikasi')->nullable();

    $table->timestamps();
});
}
};
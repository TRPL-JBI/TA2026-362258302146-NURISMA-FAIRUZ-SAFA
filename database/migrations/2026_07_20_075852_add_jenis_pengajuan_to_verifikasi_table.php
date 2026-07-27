<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('verifikasi', function (Blueprint $table) {
            $table->enum('jenis_pengajuan', [
                'pendaftaran_baru',
                'perubahan_data',
            ])
            ->default('pendaftaran_baru')
            ->after('id_user');
        });
    }

    public function down(): void
    {
        Schema::table('verifikasi', function (Blueprint $table) {
            $table->dropColumn('jenis_pengajuan');
        });
    }
};
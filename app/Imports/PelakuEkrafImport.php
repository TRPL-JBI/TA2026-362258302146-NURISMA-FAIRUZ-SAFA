<?php

namespace App\Imports;

use Throwable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\PelakuEkraf;
use App\Models\SubsektorEkraf;
use App\Models\Wilayah;
use App\Models\LokasiEkraf;

use Maatwebsite\Excel\Concerns\ToCollection;

class PelakuEkrafImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Hapus header excel
        $rows->shift();

        foreach ($rows as $row) {

            try {

                // ==========================
                // Cari Subsektor
                // ==========================

                $subsektor = SubsektorEkraf::whereRaw(
                    "LOWER(TRIM(nama_subsektor)) = ?",
                    [strtolower(trim($row[7]))]
                )->first();

                // ==========================
                // Cari Wilayah
                // ==========================

                $wilayah = Wilayah::whereRaw(
                    "LOWER(TRIM(kecamatan)) = ?",
                    [strtolower(trim($row[4]))]
                )->first();

                if (!$subsektor || !$wilayah) {

                    Log::warning('Subsektor/Wilayah tidak ditemukan', [

                        'subsektor' => $row[7],
                        'wilayah'   => $row[4]

                    ]);

                    continue;
                }

                // ==========================
                // Email
                // ==========================

                $email = trim($row[9]);

                if (
                    empty($email) ||
                    $email == '-' ||
                    !filter_var($email, FILTER_VALIDATE_EMAIL)
                ) {

                    $email = 'user' . uniqid() . '@statify.com';

                }

                if (User::where('email', $email)->exists()) {

                    $email = 'user' . uniqid() . '@statify.com';

                }

                // ==========================
                // User
                // ==========================

                $user = User::create([

                    'nama'     => trim($row[8]),
                    'email'    => $email,
                    'password' => Hash::make('12345678'),
                    'role'     => 'pelaku_ekraf'

                ]);

                // ==========================
                // Pelaku Ekraf
                // ==========================

                $pelaku = PelakuEkraf::create([

                    'id_user'          => $user->id_user,
                    'id_subsektor'     => $subsektor->id_subsektor,
                    'id_wilayah'       => $wilayah->id_wilayah,
                    'nama_perusahaan'  => trim($row[1]),
                    'nama_proyek'      => trim($row[1]),
                    'alamat'           => trim($row[2]),
                    'nomor_telp'       => trim($row[10])

                ]);

                // ==========================
                // Lokasi
                // ==========================

                if (

                    is_numeric($row[5]) &&
                    is_numeric($row[6])

                ) {

                    LokasiEkraf::create([

                        'id_ekraf'  => $pelaku->id_ekraf,
                        'longitude' => $row[5],
                        'latitude'  => $row[6]

                    ]);

                }

                Log::info('Import berhasil', [

                    'usaha' => $pelaku->nama_perusahaan

                ]);

            } catch (Throwable $e) {

                Log::error($e->getMessage());

                continue;
            }
        }
    }
}
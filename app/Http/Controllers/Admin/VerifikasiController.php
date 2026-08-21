<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use App\Models\PelakuEkraf;
use App\Models\LokasiEkraf;
use Illuminate\Support\Facades\Http;

class VerifikasiController extends Controller
{
    public function index()
{
    $verifikasi = Verifikasi::with([
        'user',
        'subsektor',
        'wilayah'
    ])->paginate(10);

    return view(
        'admin.verifikasi.index',
        compact('verifikasi')
    );
}

public function update(Request $request, $id)
{
    $request->validate([
        'status_verifikasi' => 'required|in:disetujui,ditolak',
        'catatan' => 'nullable|string',
    ]);

    $verifikasi = Verifikasi::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | Jika pengajuan disetujui
    |--------------------------------------------------------------------------
    */

    if ($request->status_verifikasi === 'disetujui') {

        $pelaku = PelakuEkraf::where(
            'id_user',
            $verifikasi->id_user
        )->first();

        /*
        |--------------------------------------------------------------------------
        | PENDAFTARAN BARU
        |--------------------------------------------------------------------------
        */

        if (!$pelaku) {

    $pelaku = PelakuEkraf::create([
        'id_user'          => $verifikasi->id_user,
        'id_subsektor'     => $verifikasi->id_subsektor,
        'id_wilayah'       => $verifikasi->id_wilayah,
        'nama_perusahaan'  => $verifikasi->nama_perusahaan,
        'nama_proyek'      => $verifikasi->nama_proyek,
        'alamat'           => $verifikasi->alamat,
        'link_gmaps'       => $verifikasi->link_gmaps,
        'nomor_telp'       => $verifikasi->nomor_telp,
    ]);

    /*
    |--------------------------------------------------------------------------
    | Ambil koordinat otomatis dari Google Maps
    |--------------------------------------------------------------------------
    */

    if ($verifikasi->link_gmaps) {

        $coordinates = $this->resolveCoordinates(
            $verifikasi->link_gmaps
        );

        if ($coordinates) {

            LokasiEkraf::create([
                'id_ekraf'  => $pelaku->id_ekraf,
                'latitude'  => $coordinates['latitude'],
                'longitude' => $coordinates['longitude'],
            ]);

        } else {

            \Log::warning(
                'Koordinat tidak ditemukan untuk link: '
                . $verifikasi->link_gmaps
            );
        }
    }
}

        /*
        |--------------------------------------------------------------------------
        | PERUBAHAN DATA
        |--------------------------------------------------------------------------
        */

        if ($verifikasi->jenis_pengajuan === 'perubahan_data') {

            if ($pelaku) {

                $pelaku->update([
                    'id_subsektor'     => $verifikasi->id_subsektor,
                    'id_wilayah'       => $verifikasi->id_wilayah,
                    'nama_perusahaan'  => $verifikasi->nama_perusahaan,
                    'nama_proyek'      => $verifikasi->nama_proyek,
                    'alamat'           => $verifikasi->alamat,
                    'link_gmaps'       => $verifikasi->link_gmaps,
                    'nomor_telp'       => $verifikasi->nomor_telp,
                ]);

if ($verifikasi->link_gmaps) {

    $coordinates = $this->resolveCoordinates(
        $verifikasi->link_gmaps
    );

    if ($coordinates) {

        LokasiEkraf::updateOrCreate(
            [
                'id_ekraf' => $pelaku->id_ekraf,
            ],
            [
                'latitude' => $coordinates['latitude'],
                'longitude' => $coordinates['longitude'],
            ]
        );

    }
}

            }

        }
    }

    /*
    |--------------------------------------------------------------------------
    | Update status verifikasi
    |--------------------------------------------------------------------------
    */

    $verifikasi->update([
        'status_verifikasi' => $request->status_verifikasi,
        'catatan' => $request->catatan,
        'tanggal_verifikasi' => now(),
    ]);

    return redirect()
        ->route('admin.verifikasi.index')
        ->with('success', 'Status verifikasi berhasil diperbarui.');
}

private function resolveCoordinates($url)
{
    try {

        $response = Http::withOptions([
            'allow_redirects' => true,
        ])->get($url);

        $finalUrl = (string) $response->effectiveUri();

        /*
        |--------------------------------------------------------------------------
        | Format:
        | /maps/@latitude,longitude
        |--------------------------------------------------------------------------
        */

        if (preg_match(
            '/@(-?\d+\.\d+),(-?\d+\.\d+)/',
            $finalUrl,
            $matches
        )) {
            return [
                'latitude' => (float) $matches[1],
                'longitude' => (float) $matches[2],
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Format:
        | /maps/search/latitude,+longitude
        |--------------------------------------------------------------------------
        */

        if (preg_match(
            '/\/maps\/search\/(-?\d+\.\d+),\+?(-?\d+\.\d+)/',
            $finalUrl,
            $matches
        )) {
            return [
                'latitude' => (float) $matches[1],
                'longitude' => (float) $matches[2],
            ];
        }

        return null;

    } catch (\Exception $e) {

        \Log::error(
            'Gagal resolve Google Maps: ' . $e->getMessage()
        );

        return null;
    }
}

}
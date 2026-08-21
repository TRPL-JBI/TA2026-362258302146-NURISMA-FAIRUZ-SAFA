<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PelakuEkraf;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use App\Models\SubsektorEkraf;
use App\Models\Wilayah;

class PengajuanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'nama_proyek'     => 'required',
            'alamat'          => 'required',
            'id_subsektor'    => 'required|exists:subsektor_ekraf,id_subsektor',
            'id_wilayah'      => 'required|exists:wilayah,id_wilayah',
            'link_gmaps'      => 'nullable|string|max:1000',
            'nomor_telp'      => 'required',
        ]);

        $statusTerakhir = Verifikasi::where('id_user', auth()->id())
            ->latest()
            ->first();

        /*
        |--------------------------------------------------------------------------
        | PENGAJUAN PERTAMA
        |--------------------------------------------------------------------------
        */
        if (!$statusTerakhir) {
            $jenisPengajuan = 'pendaftaran_baru';
        }
        /*
        |--------------------------------------------------------------------------
        | MASIH MENUNGGU
        |--------------------------------------------------------------------------
        */
        elseif ($statusTerakhir->status_verifikasi == 'menunggu') {
            return response()->json([
                'message' => 'Pengajuan Anda masih diproses admin.'
            ], 400);
        }
        /*
        |--------------------------------------------------------------------------
        | DATA SUDAH DISETUJUI
        |--------------------------------------------------------------------------
        */
        elseif ($statusTerakhir->status_verifikasi == 'disetujui') {
            $jenisPengajuan = 'perubahan_data';
        }
        /*
        |--------------------------------------------------------------------------
        | DATA DITOLAK
        |--------------------------------------------------------------------------
        */
        else {
            $jenisPengajuan = 'pendaftaran_baru';
        }

        $pengajuan = Verifikasi::create([
            'id_user'            => auth()->id(),
            'nama_perusahaan'    => $request->nama_perusahaan,
            'nama_proyek'        => $request->nama_proyek,
            'alamat'             => $request->alamat,
            'link_gmaps'         => $request->link_gmaps,
            'id_subsektor'       => $request->id_subsektor,
            'id_wilayah'         => $request->id_wilayah,
            'nomor_telp'         => $request->nomor_telp,
            'jenis_pengajuan'    => $jenisPengajuan,
            'status_verifikasi'  => 'menunggu',
            'catatan'            => null,
            'tanggal_verifikasi' => null,
        ]);

        return response()->json([
            'message' => $jenisPengajuan === 'pendaftaran_baru'
                ? 'Pendaftaran berhasil dikirim.'
                : 'Perubahan data berhasil diajukan dan sedang menunggu verifikasi admin.',
            'data' => $pengajuan
        ], 201);
    }

    public function update(Request $request)
{
    $request->validate([
        'nama_perusahaan' => 'required',
        'nama_proyek' => 'required',
        'alamat' => 'required',
        'id_subsektor' => 'required|exists:subsektor_ekraf,id_subsektor',
        'id_wilayah' => 'required|exists:wilayah,id_wilayah',
        'link_gmaps' => 'nullable|string|max:1000',
        'nomor_telp' => 'required',
    ]);

    $pengajuanMenunggu = Verifikasi::where(
        'id_user',
        auth()->id()
    )
    ->where('jenis_pengajuan', 'perubahan_data')
    ->where('status_verifikasi', 'menunggu')
    ->exists();

    if ($pengajuanMenunggu) {

        return response()->json([
            'message' =>
                'Anda masih memiliki pengajuan perubahan data yang sedang diproses admin.'
        ], 400);

    }

    $pengajuan = Verifikasi::create([
        'id_user' => auth()->id(),
        'nama_perusahaan' => $request->nama_perusahaan,
        'nama_proyek' => $request->nama_proyek,
        'alamat' => $request->alamat,
        'id_subsektor' => $request->id_subsektor,
        'id_wilayah' => $request->id_wilayah,
        'link_gmaps' => $request->link_gmaps,
        'nomor_telp' => $request->nomor_telp,
        'jenis_pengajuan' => 'perubahan_data',
        'status_verifikasi' => 'menunggu',
        'catatan' => null,
        'tanggal_verifikasi' => null,
    ]);

    return response()->json([
        'message' =>
            'Perubahan data berhasil diajukan dan menunggu persetujuan admin.',
        'data' => $pengajuan
    ], 201);
}

    public function status()
    {
        $verifikasi = Verifikasi::with([
            'subsektor',
            'wilayah'
        ])
        ->where('id_user', auth()->id())
        ->latest()
        ->first();

        if (!$verifikasi) {
            return response()->json([
                'message' => 'Belum ada pengajuan'
            ], 404);
        }

        return response()->json([
            'nama_perusahaan'    => $verifikasi->nama_perusahaan,
            'nama_proyek'        => $verifikasi->nama_proyek,
            'alamat'             => $verifikasi->alamat,
            'nomor_telp'         => $verifikasi->nomor_telp,
            'subsektor'          => $verifikasi->subsektor?->nama_subsektor,
            'wilayah'            => $verifikasi->wilayah?->kecamatan,
            'jenis_pengajuan'    => $verifikasi->jenis_pengajuan, // Perbaikan: mengganti $item dengan $verifikasi
            'status'             => $verifikasi->status_verifikasi,
            'catatan'            => $verifikasi->catatan,
            'tanggal_pengajuan'  => $verifikasi->created_at,
            'tanggal_verifikasi' => $verifikasi->tanggal_verifikasi,
        ]);
    }

    public function riwayat()
    {
        $riwayat = Verifikasi::with([
            'subsektor',
            'wilayah'
        ])
        ->where('id_user', auth()->id())
        ->orderByDesc('created_at')
        ->get();

        return response()->json([
            'total' => $riwayat->count(),
            'data'  => $riwayat->map(function ($item) {
                return [
                    'id_verifikasi'      => $item->id_verifikasi,
                    'nama_perusahaan'    => $item->nama_perusahaan,
                    'nama_proyek'        => $item->nama_proyek,
                    'alamat'             => $item->alamat,
                    'nomor_telp'         => $item->nomor_telp,
                    'subsektor'          => $item->subsektor?->nama_subsektor,
                    'wilayah'            => $item->wilayah?->kecamatan,
                    'jenis_pengajuan'    => $item->jenis_pengajuan,
                    'status'             => $item->status_verifikasi,
                    'catatan'            => $item->catatan,
                    'tanggal_pengajuan'  => $item->created_at,
                    'tanggal_verifikasi' => $item->tanggal_verifikasi,
                ];
            })
        ]);
    }

public function dataSaya()
{
    $pelaku = \App\Models\PelakuEkraf::with([
        'subsektor',
        'wilayah'
    ])
    ->where('id_user', auth()->id())
    ->first();

    if (!$pelaku) {
        return response()->json([
            'message' => 'Data pelaku Ekraf belum ditemukan.'
        ], 404);
    }

    return response()->json([
        'id_ekraf' => $pelaku->id_ekraf,
        'nama_perusahaan' => $pelaku->nama_perusahaan,
        'nama_proyek' => $pelaku->nama_proyek,
        'alamat' => $pelaku->alamat,
        'link_gmaps' => $pelaku->link_gmaps,
        'nomor_telp' => $pelaku->nomor_telp,
        'id_subsektor' => $pelaku->id_subsektor,
        'subsektor' => $pelaku->subsektor->nama_subsektor,
        'id_wilayah' => $pelaku->id_wilayah,
        'wilayah' => $pelaku->wilayah->kecamatan,
    ]);
}

public function opsiForm()
{
    return response()->json([
        'subsektor' => SubsektorEkraf::select(
            'id_subsektor',
            'nama_subsektor'
        )->get(),

        'wilayah' => Wilayah::select(
            'id_wilayah',
            'kecamatan'
        )->get(),
    ]);
}

}
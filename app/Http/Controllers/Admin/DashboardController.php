<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PelakuEkraf;
use App\Models\Verifikasi;
use App\Models\SubsektorEkraf;
use App\Models\Wilayah;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ==========================
        // CARD
        // ==========================

        $totalPelaku = PelakuEkraf::count();

        $totalSubsektor = SubsektorEkraf::count();

        $totalWilayah = Wilayah::count();

        $totalUser = User::count();

        // ==========================
        // STATUS VERIFIKASI
        // ==========================

        $menunggu = Verifikasi::where(
            'status_verifikasi',
            'menunggu'
        )->count();

        $disetujui = Verifikasi::where(
            'status_verifikasi',
            'disetujui'
        )->count();

        $ditolak = Verifikasi::where(
            'status_verifikasi',
            'ditolak'
        )->count();

        // ==========================
        // GRAFIK SUBSEKTOR
        // ==========================

        $chartSubsektor = PelakuEkraf::join(
                'subsektor_ekraf',
                'pelaku_ekraf.id_subsektor',
                '=',
                'subsektor_ekraf.id_subsektor'
            )
            ->select(
                'subsektor_ekraf.nama_subsektor',
                DB::raw('COUNT(*) as jumlah')
            )
            ->groupBy('subsektor_ekraf.nama_subsektor')
            ->get();

        // ==========================
        // GRAFIK WILAYAH
        // ==========================

        $chartWilayah = PelakuEkraf::join(
                'wilayah',
                'pelaku_ekraf.id_wilayah',
                '=',
                'wilayah.id_wilayah'
            )
            ->select(
                'wilayah.kecamatan',
                DB::raw('COUNT(*) as jumlah')
            )
            ->groupBy('wilayah.kecamatan')
            ->get();

        return view(
            'admin.dashboard',
            compact(
                'totalPelaku',
                'totalSubsektor',
                'totalWilayah',
                'totalUser',
                'menunggu',
                'disetujui',
                'ditolak',
                'chartSubsektor',
                'chartWilayah'
            )
        );
    }
}
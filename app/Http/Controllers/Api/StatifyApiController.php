<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PelakuEkraf;
use App\Models\SubsektorEkraf;
use App\Models\Wilayah;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatifyApiController extends Controller
{
    public function index(Request $request)
    {
        $totalPelaku = PelakuEkraf::count();

        $totalSubsektor = SubsektorEkraf::count();

        $totalWilayah = Wilayah::count();

       $querySub = PelakuEkraf::join(
        'subsektor_ekraf',
        'pelaku_ekraf.id_subsektor',
        '=',
        'subsektor_ekraf.id_subsektor'
);

if ($request->id_subsektor != '') {

    $querySub->where(
        'pelaku_ekraf.id_subsektor',
        $request->id_subsektor
    );

}

$perSubsektor = $querySub
    ->select(
        'subsektor_ekraf.nama_subsektor',
        DB::raw('COUNT(*) as jumlah')
    )
    ->groupBy('subsektor_ekraf.nama_subsektor')
    ->get();

$query = PelakuEkraf::join(
    'wilayah',
    'pelaku_ekraf.id_wilayah',
    '=',
    'wilayah.id_wilayah'
);

if ($request->id_subsektor != '') {

    $query->where(
        'pelaku_ekraf.id_subsektor',
        $request->id_subsektor
    );

}

$perWilayah = $query
    ->select(
        'wilayah.kecamatan',
        DB::raw('COUNT(*) as jumlah')
    )
    ->groupBy('wilayah.kecamatan')
    ->get();

        return response()->json([
            'total_pelaku' => $totalPelaku,
            'total_subsektor' => $totalSubsektor,
            'total_kecamatan' => $totalWilayah,
            'per_subsektor' => $perSubsektor,
            'per_wilayah' => $perWilayah
        ]);
    }
}
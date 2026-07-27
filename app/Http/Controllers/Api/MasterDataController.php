<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubsektorEkraf;
use App\Models\Wilayah;

class MasterDataController extends Controller
{
    public function subsektor()
    {
        return response()->json(
            SubsektorEkraf::select(
                'id_subsektor',
                'nama_subsektor'
            )
            ->orderBy('nama_subsektor')
            ->get()
        );
    }

    public function wilayah()
    {
        return response()->json(
            Wilayah::select(
                'id_wilayah',
                'kecamatan'
            )
            ->orderBy('kecamatan')
            ->get()
        );
    }
}
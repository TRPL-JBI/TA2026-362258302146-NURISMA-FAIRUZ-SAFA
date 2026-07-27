<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PelakuEkraf;

class PelakuEkrafController extends Controller
{
    public function map()
    {
        $data = PelakuEkraf::with([
            'lokasi',
            'subsektor',
            'wilayah'
        ])->get();

        return response()->json(
            $data->map(function ($item) {

                return [
                    'id_ekraf' => $item->id_ekraf,

                    'nama_perusahaan' =>
                        $item->nama_perusahaan,

                    'nama_proyek' =>
                        $item->nama_proyek,

                    'alamat' =>
                        $item->alamat,

                    'nomor_telp' => $item->nomor_telp,

                    'subsektor' =>
                        $item->subsektor?->nama_subsektor,

                    'wilayah' =>
                        $item->wilayah?->kecamatan,

                    'latitude' =>
                        $item->lokasi?->latitude,

                    'longitude' =>
                        $item->lokasi?->longitude,
                ];

            })
        );
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PelakuEkraf;
use App\Models\SubsektorEkraf;

class StatifyWilayahController extends Controller
{
    public function index()
    {
        $pelaku = PelakuEkraf::with([
            'subsektor',
            'wilayah',
            'lokasi'
        ])->get();

        $subsektor = SubsektorEkraf::orderBy('nama_subsektor')->get();

        return view(
            'admin.statify.wilayah',
            compact(
                'pelaku',
                'subsektor'
            )
        );
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubsektorEkraf;

class StatifyController extends Controller
{
    // Halaman utama Statify (boleh diarahkan ke Wilayah)
    public function index()
    {
        return view('admin.statify.wilayah');
    }

    // Statify Kategori
    public function kategori()
    {
        $subsektor = SubsektorEkraf::orderBy('nama_subsektor')->get();

        return view(
            'admin.statify.kategori',
            compact('subsektor')
        );
    }

    // Statify Jumlah
    public function jumlah()
    {
        return view('admin.statify.jumlah');
    }
}
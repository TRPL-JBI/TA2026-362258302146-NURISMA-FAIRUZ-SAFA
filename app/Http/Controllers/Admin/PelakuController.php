<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PelakuEkraf;
use App\Models\User;
use App\Models\SubsektorEkraf;
use App\Models\Wilayah;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Verifikasi;

class PelakuController extends Controller
{
   public function index()
{
    $pelaku = PelakuEkraf::with([
        'user',
        'subsektor',
        'wilayah'
    ])->paginate(10);

    return view('admin.pelaku.index', compact('pelaku'));
}
}
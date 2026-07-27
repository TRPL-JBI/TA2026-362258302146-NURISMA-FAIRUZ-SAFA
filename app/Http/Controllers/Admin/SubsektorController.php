<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubsektorEkraf;

class SubsektorController extends Controller
{
    public function index()
    {
        $subsektor = SubsektorEkraf::all();

        return view(
            'admin.subsektor.index',
            compact('subsektor')
        );
    }
}
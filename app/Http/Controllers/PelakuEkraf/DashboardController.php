<?php

namespace App\Http\Controllers\PelakuEkraf;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pelaku.dashboard');
    }
}
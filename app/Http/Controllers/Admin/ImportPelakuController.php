<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PelakuEkrafImport;

class ImportPelakuController extends Controller
{
    public function index()
    {
        return view('admin.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new PelakuEkrafImport, $request->file('file'));

        return redirect()
            ->back()
            ->with('success','Import berhasil!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    public function index()
    {
        $pengadaan = DB::select("SELECT * FROM pengadaan");

        return view('pengadaan.index', compact('pengadaan'));
    }
}


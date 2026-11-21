<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MarginPenjualanController extends Controller
{
    public function index()
    {
        $margin = DB::select('SELECT * FROM view_margin_penjualan');

        return view('margin_penjualan.index', compact('margin'));
    }

    public function create()
    {
        $user = DB::select('SELECT iduser, username FROM user');

        return view('margin_penjualan.create', compact('user'));
    }

    public function store(Request $request)
    {
    $persen = $request->input('persen');
    $status = $request->input('status');
    $iduser = $request->input('iduser');

    DB::insert(
        'INSERT INTO margin_penjualan (persen, status, iduser, created_at, updated_at)
        VALUES (?, ?, ?, NOW(), NOW())',
        [$persen, $status, $iduser]
    );

    return redirect('/margin-penjualan');
    }

    public function edit($id)
    {
    $margin = DB::select(
        'SELECT * FROM margin_penjualan WHERE idmargin_penjualan = ?',
        [$id]
    );

    $user = DB::select('SELECT iduser, username FROM user');

    return view('margin_penjualan.edit', compact('margin', 'user'));
    }

    public function update(Request $request, $id)
    {
    $persen = $request->input('persen');
    $status = $request->input('status');
    $iduser = $request->input('iduser');

    DB::update(
        'UPDATE margin_penjualan
        SET persen = ?, status = ?, iduser = ?, updated_at = NOW()
        WHERE idmargin_penjualan = ?',
        [$persen, $status, $iduser, $id]
    );

    return redirect('/margin-penjualan');
    }

    public function destroy($id)
    {
        DB::delete(
            'DELETE FROM margin_penjualan WHERE idmargin_penjualan = ?',
            [$id]
        );

        return redirect('/margin-penjualan');
    }
}

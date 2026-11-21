<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = DB::select('SELECT * FROM view_barang');

        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $satuan = DB::select('SELECT * FROM satuan WHERE status = 1');

        return view('barang.create', compact('satuan'));
    }

    public function store(Request $request)
    {
        $jenis = $request->input('jenis');
        $nama = $request->input('nama');
        $idsatuan = $request->input('idsatuan');
        $status = $request->input('status');
        $harga = $request->input('harga');

        DB::insert(
            'INSERT INTO barang (jenis, nama, idsatuan, status, harga) VALUES (?, ?, ?, ?, ?)',
            [$jenis, $nama, $idsatuan, $status, $harga]
        );

        return redirect('/barang');
    }

    public function edit($id)
    {
        $barang = DB::select(
            'SELECT * FROM barang WHERE idbarang = ?',
            [$id]
        );

        $satuan = DB::select('SELECT * FROM satuan');

        return view('barang.edit', compact('barang', 'satuan'));
    }

    public function update(Request $request, $id)
    {
        $jenis = $request->input('jenis');
        $nama = $request->input('nama');
        $idsatuan = $request->input('idsatuan');
        $status = $request->input('status');
        $harga = $request->input('harga');

        DB::update(
            'UPDATE barang SET jenis = ?, nama = ?, idsatuan = ?, status = ?, harga = ? WHERE idbarang = ?',
            [$jenis, $nama, $idsatuan, $status, $harga, $id]
        );

        return redirect('/barang');
    }

    public function destroy($id)
    {
        DB::delete(
            'DELETE FROM barang WHERE idbarang = ?',
            [$id]
        );

        return redirect('/barang');
    }
}

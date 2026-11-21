<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $satuan = DB::select('SELECT * FROM view_satuan');

        return view('satuan.index', compact('satuan'));
    }

    public function create()
    {
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        $nama_satuan = $request->input('nama_satuan');
        $status = $request->input('status');

        DB::insert(
            'INSERT INTO satuan (nama_satuan, status) VALUES (?, ?)',
            [$nama_satuan, $status]
        );

        return redirect('/satuan');
    }

    public function edit($id)
    {
        $satuan = DB::select(
            'SELECT * FROM satuan WHERE idsatuan = ?',
            [$id]
        );

        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, $id)
    {
        $nama_satuan = $request->input('nama_satuan');
        $status = $request->input('status');

        DB::update(
            'UPDATE satuan SET nama_satuan = ?, status = ? WHERE idsatuan = ?',
            [$nama_satuan, $status, $id]
        );

        return redirect('/satuan');
    }

    public function destroy($id)
    {
    DB::delete(
        'DELETE FROM satuan WHERE idsatuan = ?',
        [$id]
    );

    return redirect('/satuan');
    }
}

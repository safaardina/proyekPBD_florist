<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendor = DB::select('SELECT * FROM view_vendor');

        return view('vendor.index', compact('vendor'));
    }

    public function create()
    {
    return view('vendor.create');
    }

    public function edit($id)
    {
        $vendor = DB::select(
            'SELECT * FROM vendor WHERE idvendor = ?',
            [$id]
        );

        return view('vendor.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
    $nama_vendor = $request->input('nama_vendor');
    $badan_hukum = $request->input('badan_hukum');
    $status = $request->input('status');

    DB::update(
        'UPDATE vendor SET nama_vendor = ?, badan_hukum = ?, status = ? WHERE idvendor = ?',
        [$nama_vendor, $badan_hukum, $status, $id]
    );

    return redirect('/vendor');
    }

    public function destroy($id)
    {
        DB::delete(
            'DELETE FROM vendor WHERE idvendor = ?',
            [$id]
        );

        return redirect('/vendor');
    }

    public function store(Request $request)
    {
    $nama_vendor = $request->input('nama_vendor');
    $badan_hukum = $request->input('badan_hukum');
    $status = $request->input('status');

    DB::insert(
        'INSERT INTO vendor (nama_vendor, badan_hukum, status) VALUES (?, ?, ?)',
        [$nama_vendor, $badan_hukum, $status]
    );

    return redirect('/vendor');
    }
}

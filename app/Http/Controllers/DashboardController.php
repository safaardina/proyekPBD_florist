<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStok = DB::selectOne("
            SELECT COALESCE(SUM(ks.stock), 0) AS total
            FROM kartu_stok ks
            INNER JOIN (
                SELECT idbarang, MAX(idkartu_stok) AS id_terakhir
                FROM kartu_stok
                GROUP BY idbarang
            ) terbaru
                ON ks.idkartu_stok = terbaru.id_terakhir
        ")->total;
        $totalPengadaan = DB::selectOne(" SELECT COUNT(*) AS total FROM pengadaan ")->total;
        $totalPenerimaan = DB::selectOne(" SELECT COUNT(*) AS total FROM penerimaan ")->total;
        $totalPenjualan = DB::selectOne(" SELECT COUNT(*) AS total FROM penjualan ")->total;

        return view('dashboard.index', compact(
            'totalStok',
            'totalPengadaan',
            'totalPenerimaan',
            'totalPenjualan'
        ));
    }
}

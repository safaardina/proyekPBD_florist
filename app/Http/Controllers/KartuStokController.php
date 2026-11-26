<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class KartuStokController extends Controller
{
    public function index()
    {
        // Ringkasan stok seluruh barang
        $ringkasanStok = DB::select("
            SELECT
                b.idbarang,
                b.nama AS nama_barang,
                COALESCE(rekap.total_masuk, 0) AS total_masuk,
                COALESCE(rekap.total_keluar, 0) AS total_keluar,
                COALESCE(ks.stock, 0) AS stock
            FROM barang b

            LEFT JOIN (
                SELECT
                    idbarang,
                    SUM(masuk) AS total_masuk,
                    SUM(keluar) AS total_keluar
                FROM kartu_stok
                GROUP BY idbarang
            ) rekap
                ON b.idbarang = rekap.idbarang

            LEFT JOIN kartu_stok ks
                ON ks.idkartu_stok = (
                    SELECT MAX(k2.idkartu_stok)
                    FROM kartu_stok k2
                    WHERE k2.idbarang = b.idbarang
                )

            ORDER BY b.nama ASC
        ");

        // Riwayat transaksi kartu stok
        $kartuStok = DB::select("
            SELECT
                ks.idkartu_stok,
                ks.jenis_transaksi,
                ks.masuk,
                ks.keluar,
                ks.stock,
                ks.created_at,
                b.nama AS nama_barang
            FROM kartu_stok ks
            JOIN barang b
                ON ks.idbarang = b.idbarang
            ORDER BY ks.idkartu_stok DESC
        ");

        return view('kartu-stok.index', compact(
            'ringkasanStok',
            'kartuStok'
        ));
    }
}

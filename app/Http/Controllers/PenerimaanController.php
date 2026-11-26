<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PenerimaanController extends Controller
{
    public function index()
    {
        // Waiting List Pengadaan
        $waitingList = DB::select("
            SELECT
                p.idpengadaan,
                p.`timestamp` AS tanggal,
                v.nama_vendor,
                u.username,
                p.total_nilai
            FROM pengadaan p
            JOIN vendor v
                ON p.vendor_idvendor = v.idvendor
            JOIN user u
                ON p.user_iduser = u.iduser
            WHERE p.status = 'C'
                AND NOT EXISTS (
                    SELECT 1
                    FROM penerimaan r
                    WHERE r.idpengadaan = p.idpengadaan
                )
            ORDER BY p.idpengadaan DESC
        ");

        // Riwayat Penerimaan
    $penerimaan = DB::select("
        SELECT
            r.idpenerimaan,
            r.created_at,
            r.status,
            p.idpengadaan,
            v.nama_vendor,
            u.username
        FROM penerimaan r
        JOIN pengadaan p
            ON r.idpengadaan = p.idpengadaan
        JOIN vendor v
            ON p.vendor_idvendor = v.idvendor
        JOIN user u
            ON r.iduser = u.iduser
        ORDER BY r.idpenerimaan DESC
    ");

    return view('penerimaan.index', compact(
        'waitingList',
        'penerimaan'
    ));
    }

    public function proses($id)
    {
    // Cek apakah pengadaan tersedia dan sudah dikonfirmasi
    $pengadaan = DB::select("
        SELECT idpengadaan
        FROM pengadaan
        WHERE idpengadaan = ?
        AND status = 'C'
        LIMIT 1
    ", [$id]);

    if (empty($pengadaan)) {
        return redirect('/penerimaan')
            ->with('error', 'Pengadaan tidak ditemukan atau belum dikonfirmasi.');
    }

    // Cek apakah pengadaan sudah memiliki penerimaan
    $sudahAda = DB::select("
        SELECT idpenerimaan
        FROM penerimaan
        WHERE idpengadaan = ?
        LIMIT 1
    ", [$id]);

    if (!empty($sudahAda)) {
        return redirect('/penerimaan')
            ->with('error', 'Pengadaan ini sudah memiliki transaksi penerimaan.');
    }

    // Buat transaksi penerimaan
    DB::insert("
        INSERT INTO penerimaan
            (created_at, status, idpengadaan, iduser)
        VALUES
            (NOW(), 'B', ?, ?)
    ", [
        $id,
        session('iduser')
    ]);

    return redirect('/penerimaan')
        ->with('success', 'Transaksi penerimaan berhasil dibuat.');
    }


    public function detail($id)
    {
        // Ambil data transaksi penerimaan
        $penerimaan = DB::select("
            SELECT
                r.idpenerimaan,
                r.created_at,
                r.status,
                p.idpengadaan,
                v.nama_vendor
            FROM penerimaan r
            JOIN pengadaan p
                ON r.idpengadaan = p.idpengadaan
            JOIN vendor v
                ON p.vendor_idvendor = v.idvendor
            WHERE p.idpengadaan = ?
            LIMIT 1
        ", [$id]);

        if (empty($penerimaan)) {
            return redirect('/penerimaan')
                ->with('error', 'Transaksi penerimaan tidak ditemukan.');
        }

        $penerimaan = $penerimaan[0];

        // Ambil daftar barang dan jumlah yang sudah diterima
        $detailBarang = DB::select("
            SELECT
                dp.idbarang,
                b.nama AS nama_barang,
                dp.jumlah AS jumlah_pesan,
                COALESCE(SUM(dr.jumlah_terima), 0) AS jumlah_diterima,
                dp.jumlah - COALESCE(SUM(dr.jumlah_terima), 0) AS sisa
            FROM detail_pengadaan dp
            JOIN barang b
                ON dp.idbarang = b.idbarang
            LEFT JOIN detail_penerimaan dr
                ON dr.barang_idbarang = dp.idbarang
                AND dr.idpenerimaan = ?
            WHERE dp.idpengadaan = ?
            GROUP BY
                dp.idbarang,
                b.nama,
                dp.jumlah
            ORDER BY dp.idbarang
        ", [
            $penerimaan->idpenerimaan,
            $id
        ]);

        return view('penerimaan.detail', compact(
            'penerimaan',
            'detailBarang'
        ));
    }

    public function terima(Request $request, $id)
    {
    // Ambil transaksi penerimaan
    $penerimaan = DB::select("
        SELECT idpenerimaan, idpengadaan, status
        FROM penerimaan
        WHERE idpenerimaan = ?
        LIMIT 1
    ", [$id]);

    if (empty($penerimaan)) {
        return redirect('/penerimaan')
            ->with('error', 'Transaksi penerimaan tidak ditemukan.');
    }

    $penerimaan = $penerimaan[0];

    if ($penerimaan->status == 'S') {
        return redirect('/penerimaan/' . $penerimaan->idpengadaan . '/detail')
            ->with('error', 'Penerimaan sudah selesai.');
    }

    // Ambil daftar barang beserta sisa jumlah pesan
    $detailBarang = DB::select("
        SELECT
            dp.idbarang,
            dp.jumlah,
            dp.harga_satuan,
            COALESCE(SUM(dr.jumlah_terima), 0) AS jumlah_diterima
        FROM detail_pengadaan dp
        LEFT JOIN detail_penerimaan dr
            ON dr.barang_idbarang = dp.idbarang
            AND dr.idpenerimaan = ?
        WHERE dp.idpengadaan = ?
        GROUP BY
            dp.idbarang,
            dp.jumlah,
            dp.harga_satuan
    ", [
        $id,
        $penerimaan->idpengadaan
    ]);

    $input = $request->input('jumlah_terima', []);
    $adaInput = false;

    // Simpan jumlah barang yang diterima
    foreach ($detailBarang as $barang) {

        $jumlah = $input[$barang->idbarang] ?? 0;

        if (filter_var($jumlah, FILTER_VALIDATE_INT) === false || $jumlah < 0) {
            return back()->with('error', 'Jumlah penerimaan harus berupa bilangan bulat positif atau nol.');
        }

        $sisa = $barang->jumlah - $barang->jumlah_diterima;

        if ($jumlah > $sisa) {
            return back()->with(
                'error',
                'Jumlah penerimaan melebihi sisa pesanan barang.'
            );
        }

        if ($jumlah > 0) {
            $subtotal = $jumlah * $barang->harga_satuan;

            DB::insert("
                INSERT INTO detail_penerimaan
                    (
                        idpenerimaan,
                        barang_idbarang,
                        jumlah_terima,
                        harga_satuan_terima,
                        sub_total_terima
                    )
                VALUES (?, ?, ?, ?, ?)
            ", [
                $id,
                $barang->idbarang,
                $jumlah,
                $barang->harga_satuan,
                $subtotal
            ]);

            $adaInput = true;
        }
    }

    if (!$adaInput) {
        return back()->with(
            'error',
            'Masukkan jumlah barang yang diterima terlebih dahulu.'
        );
    }

    // Hitung kembali jumlah penerimaan
    $rekap = DB::selectOne("
        SELECT
            COALESCE(SUM(dr.jumlah_terima), 0) AS total_diterima,
            COUNT(*) AS total_item,
            SUM(
                CASE
                    WHEN COALESCE(dr.jumlah_terima, 0) >= dp.jumlah
                    THEN 1
                    ELSE 0
                END
            ) AS item_selesai
        FROM detail_pengadaan dp
        LEFT JOIN (
            SELECT
                barang_idbarang,
                SUM(jumlah_terima) AS jumlah_terima
            FROM detail_penerimaan
            WHERE idpenerimaan = ?
            GROUP BY barang_idbarang
        ) dr
            ON dr.barang_idbarang = dp.idbarang
        WHERE dp.idpengadaan = ?
    ", [
        $id,
        $penerimaan->idpengadaan
    ]);

    // Tentukan status penerimaan
    if ($rekap->total_diterima == 0) {
        $status = 'B';
    } elseif ($rekap->item_selesai == $rekap->total_item) {
        $status = 'S';
    } else {
        $status = 'P';
    }

    // Update status penerimaan
    DB::update("
        UPDATE penerimaan
        SET status = ?
        WHERE idpenerimaan = ?
    ", [
        $status,
        $id
    ]);

    return redirect('/penerimaan/' . $penerimaan->idpengadaan . '/detail')
        ->with('success', 'Penerimaan barang berhasil disimpan.');
    }
}

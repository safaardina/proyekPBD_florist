<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    public function index(Request $request)
    {
    $pengadaan = DB::select("
        SELECT
            p.idpengadaan,
            p.`timestamp` AS tanggal,
            v.nama_vendor,
            u.username,
            p.status,
            p.subtotal_nilai,
            p.ppn,
            p.total_nilai
        FROM pengadaan p
        JOIN vendor v ON p.vendor_idvendor = v.idvendor
        JOIN user u ON p.user_iduser = u.iduser
        ORDER BY p.idpengadaan DESC
    ");

    // Mengambil data untuk form
    $vendor = DB::select("
        SELECT * FROM vendor WHERE status = 1
    ");

    $user = DB::select("
        SELECT * FROM user
    ");

    $barang = [];

    // Menyiapkan detail pengadaan yang sedang dibuka
    $pengadaanAktif = null;
    $detail = [];

    if ($request->filled('id')) {

        $hasil = DB::select("
            SELECT * FROM pengadaan
            WHERE idpengadaan = ?
        ", [$request->id]);

        if (!empty($hasil)) {
            $pengadaanAktif = $hasil[0];

            $barang = DB::select("
                SELECT *
                FROM barang
                WHERE status = 1
                AND idvendor = ?
            ", [$pengadaanAktif->vendor_idvendor]);

            $detail = DB::select("
                SELECT
                    dp.iddetail_pengadaan,
                    dp.idbarang,
                    b.nama,
                    dp.harga_satuan,
                    dp.jumlah,
                    dp.sub_total
                FROM detail_pengadaan dp
                JOIN barang b ON dp.idbarang = b.idbarang
                WHERE dp.idpengadaan = ?
            ", [$request->id]);
        }
    }

    return view('pengadaan.index', compact(
        'pengadaan',
        'vendor',
        'user',
        'barang',
        'pengadaanAktif',
        'detail'
    ));

    }

    public function create()
    {
        $vendor = DB::select("SELECT * FROM vendor WHERE status = 1");

        $user = DB::select("SELECT * FROM user");

        return view('pengadaan.create', compact('vendor', 'user'));
    }

    public function store(Request $request)
    {
        $vendor = DB::select("
            SELECT idvendor
            FROM vendor
            WHERE idvendor = ?
                AND status = 1
        ", [$request->idvendor]);

        if (empty($vendor)) {
            return redirect('/pengadaan')
                ->with('error', 'Vendor tidak ditemukan atau sudah tidak aktif.');
        }

    DB::insert("
        INSERT INTO pengadaan (
            `timestamp`,
            user_iduser,
            status,
            vendor_idvendor,
            subtotal_nilai,
            ppn,
            total_nilai
        )
        VALUES (?, ?, 'D', ?, 0, 0, 0)
    ", [
        $request->tanggal,
        $request->iduser,
        $request->idvendor
    ]);

    $hasil = DB::select("SELECT LAST_INSERT_ID() AS id");
    $id = $hasil[0]->id;

    return redirect('/pengadaan?id=' . $id)
        ->with('success', 'Draft pengadaan berhasil dibuat.');
    }

    public function konfirmasi($id)
    {
    DB::update("
        UPDATE pengadaan
        SET status = 'C'
        WHERE idpengadaan = ?
            AND status = 'D'
    ", [$id]);

    return redirect('/pengadaan')
        ->with('success', 'Pengadaan berhasil dikonfirmasi.');
    }

    public function createDetail($id)
    {
    $barang = DB::select("
        SELECT * FROM barang
        WHERE status = 1
    ");

    $pengadaan = DB::select("
        SELECT * FROM pengadaan
        WHERE idpengadaan = ?
    ", [$id]);

    $detail = DB::select("
        SELECT
            dp.iddetail_pengadaan,
            b.nama,
            dp.harga_satuan,
            dp.jumlah,
            dp.sub_total
        FROM detail_pengadaan dp
        JOIN barang b ON dp.idbarang = b.idbarang
        WHERE dp.idpengadaan = ?
    ", [$id]);

    return view('pengadaan.detail', compact('barang', 'pengadaan', 'detail'));
    }

    public function storeDetail(Request $request)
    {

        $validasiBarang = DB::select("
            SELECT b.idbarang
            FROM barang b
            JOIN pengadaan p
                ON b.idvendor = p.vendor_idvendor
            WHERE b.idbarang = ?
            AND p.idpengadaan = ?
            AND p.status = 'D'
        ", [
            $request->idbarang,
            $request->idpengadaan
        ]);

        if (empty($validasiBarang)) {
            return redirect('/pengadaan?id=' . $request->idpengadaan)
                ->with('error', 'Barang tidak sesuai dengan vendor atau tidak aktif.');
        }

    $subtotal = $request->harga_satuan * $request->jumlah;

    // Menyimpan barang ke detail pengadaan
    DB::insert("
        INSERT INTO detail_pengadaan (
            harga_satuan,
            jumlah,
            sub_total,
            idbarang,
            idpengadaan
        )
        VALUES (?, ?, ?, ?, ?)
    ", [
        $request->harga_satuan,
        $request->jumlah,
        $subtotal,
        $request->idbarang,
        $request->idpengadaan
    ]);

    // Menghitung subtotal dan total pengadaan
    DB::update("
        UPDATE pengadaan
        SET
            subtotal_nilai = (
                SELECT COALESCE(SUM(sub_total), 0)
                FROM detail_pengadaan
                WHERE idpengadaan = ?
            ),
            total_nilai = (
                SELECT COALESCE(SUM(sub_total), 0)
                FROM detail_pengadaan
                WHERE idpengadaan = ?
            ) + COALESCE(ppn, 0)
        WHERE idpengadaan = ?
    ", [
        $request->idpengadaan,
        $request->idpengadaan,
        $request->idpengadaan
    ]);

    return redirect('/pengadaan?id=' . $request->idpengadaan)
        ->with('success', 'Barang berhasil ditambahkan.');

    }

}


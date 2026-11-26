<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = DB::select("
            SELECT
                p.idpenjualan,
                p.created_at,
                p.subtotal_nilai,
                p.ppn,
                p.total_nilai,
                u.username
            FROM penjualan p
            LEFT JOIN user u
                ON p.iduser = u.iduser
            ORDER BY p.idpenjualan DESC
        ");

        return view('penjualan.index', compact('penjualan'));
    }

    public function detail($id)
    {
        // Mengambil informasi utama transaksi
        $transaksi = DB::selectOne("
            SELECT
                p.idpenjualan,
                p.created_at,
                p.subtotal_nilai,
                p.ppn,
                p.total_nilai,
                u.username,
                m.persen AS margin
            FROM penjualan p
            LEFT JOIN user u
                ON p.iduser = u.iduser
            LEFT JOIN margin_penjualan m
                ON p.idmargin_penjualan = m.idmargin_penjualan
            WHERE p.idpenjualan = ?
        ", [$id]);

        if (!$transaksi) {
            abort(404);
        }

        // Mengambil daftar barang dalam transaksi
        $detail = DB::select("
            SELECT
                dp.idbarang,
                b.nama,
                dp.harga_satuan,
                dp.jumlah,
                dp.subtotal
            FROM detail_penjualan dp
            JOIN barang b
                ON dp.idbarang = b.idbarang
            WHERE dp.idpenjualan = ?
        ", [$id]);

        return view('penjualan.detail', compact(
            'transaksi',
            'detail'
        ));
    }


    public function create()
    {
    $marginAktif = DB::selectOne("
        SELECT idmargin_penjualan, persen
        FROM margin_penjualan
        WHERE status = 1
        LIMIT 1
    ");


    $barang = DB::select("
        SELECT
            b.idbarang,
            b.nama,
            b.harga AS harga_modal,
            COALESCE(ks.stock, 0) AS stock,

            fn_hitung_margin(
                b.harga,
                COALESCE(?, 0)
            ) AS nominal_margin,

            b.harga + fn_hitung_margin(
                b.harga,
                COALESCE(?, 0)
            ) AS harga_jual

        FROM barang b

        LEFT JOIN kartu_stok ks
            ON ks.idkartu_stok = (
                SELECT MAX(k2.idkartu_stok)
                FROM kartu_stok k2
                WHERE k2.idbarang = b.idbarang
            )

        WHERE b.status = 1
            AND COALESCE(ks.stock, 0) > 0

        ORDER BY b.nama ASC
    ", [
        $marginAktif->persen ?? 0,
        $marginAktif->persen ?? 0
    ]);


    return view('penjualan.create', compact(
        'marginAktif',
        'barang'
    ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:0'
        ]);

        $jumlahBarang = array_filter(
            $request->jumlah,
            function ($jumlah) {
                return $jumlah > 0;
            }
        );

        if (count($jumlahBarang) == 0) {
            return back()
                ->withInput()
                ->with('error', 'Pilih minimal satu barang untuk dijual.');
        }

        $marginAktif = DB::selectOne("
            SELECT idmargin_penjualan, persen
            FROM margin_penjualan
            WHERE status = 1
            LIMIT 1
        ");

        if (!$marginAktif) {
            return back()
                ->withInput()
                ->with('error', 'Belum ada margin penjualan yang aktif.');
        }

        try {
            DB::transaction(function () use (
                $jumlahBarang,
                $marginAktif
            ) {
                // Membuat transaksi penjualan
                DB::insert("
                    INSERT INTO penjualan (
                        created_at,
                        subtotal_nilai,
                        ppn,
                        total_nilai,
                        iduser,
                        idmargin_penjualan
                    )
                    VALUES (
                        NOW(), 0, 0, 0, ?, ?
                    )
                ", [
                    session('iduser'),
                    $marginAktif->idmargin_penjualan
                ]);

                $idPenjualan = DB::getPdo()->lastInsertId();

                // Menyimpan setiap barang yang dijual
                foreach ($jumlahBarang as $idBarang => $jumlah) {

                    $barang = DB::selectOne("
                        SELECT
                            harga,
                            harga + fn_hitung_margin(
                                harga, ?
                            ) AS harga_jual
                        FROM barang
                        WHERE idbarang = ?
                            AND status = 1
                    ", [
                        $marginAktif->persen,
                        $idBarang
                    ]);

                    if (!$barang) {
                        throw new \Exception('Barang tidak ditemukan atau tidak aktif.');
                    }

                    $hargaJual = round($barang->harga_jual);
                    $subtotal = $hargaJual * $jumlah;

                    DB::insert("
                        INSERT INTO detail_penjualan (
                            harga_satuan,
                            jumlah,
                            subtotal,
                            idpenjualan,
                            idbarang
                        )
                        VALUES (?, ?, ?, ?, ?)
                    ", [
                        $hargaJual,
                        $jumlah,
                        $subtotal,
                        $idPenjualan,
                        $idBarang
                    ]);
                }

                // Menghitung subtotal dan total dengan PPN 11%
                DB::statement("
                    CALL sp_hitung_total_penjualan(?, ?)
                ", [
                    $idPenjualan,
                    11
                ]);
            });

            return redirect()
                ->route('penjualan.index')
                ->with('success', 'Transaksi penjualan berhasil disimpan!');

        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
    }
    }


}

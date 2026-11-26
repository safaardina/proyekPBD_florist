
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="page-header">
    <h1>Dashboard Bloomify</h1>
    <p>Selamat datang di Bloomify Florist Management System!</p>
</div>

<div class="content">
    <h2 style="color: #49313D; margin-bottom: 10px;">
        Ringkasan Aktivitas
    </h2>

    <p style="color: #888;">
        Pantau persediaan barang dan aktivitas transaksi toko Anda.
    </p>

    <div style="
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-top: 25px;
    ">

        <div style="background: #FFF1F6; padding: 25px; border-radius: 12px;">
            <p style="color: #9B647D;">Total Stok Barang</p>
            <h2 style="color: #49313D; font-size: 30px; margin-top: 10px;">
                {{ $totalStok }}
            </h2>
        </div>

        <div style="background: #FFF1F6; padding: 25px; border-radius: 12px;">
            <p style="color: #9B647D;">Total Pengadaan</p>
            <h2 style="color: #49313D; font-size: 30px; margin-top: 10px;">
                {{ $totalPengadaan }}
            </h2>
        </div>

        <div style="background: #FFF1F6; padding: 25px; border-radius: 12px;">
            <p style="color: #9B647D;">Total Penerimaan</p>
            <h2 style="color: #49313D; font-size: 30px; margin-top: 10px;">
                {{ $totalPenerimaan }}
            </h2>
        </div>

        <div style="background: #FFF1F6; padding: 25px; border-radius: 12px;">
            <p style="color: #9B647D;">Total Penjualan</p>
            <h2 style="color: #49313D; font-size: 30px; margin-top: 10px;">
                {{ $totalPenjualan }}
            </h2>
        </div>

    </div>
</div>

@endsection

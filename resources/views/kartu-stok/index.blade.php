
@extends('layouts.app')

@section('title', 'Kartu Stok')

@section('content')

<div class="page-header">
    <h1>Kartu Stok</h1>
    <p>Monitoring persediaan dan riwayat pergerakan stok barang Bloomify.</p>
</div>

<div class="content">

    {{-- RINGKASAN STOK --}}
    <h2 style="color: #49313D; margin-bottom: 8px;">
        Ringkasan Stok Barang
    </h2>

    <p style="color: #888; margin-bottom: 20px;">
        Informasi jumlah barang masuk, keluar, dan stok tersedia saat ini.
    </p>

    <table style="margin-bottom: 35px;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Total Masuk</th>
                <th>Total Keluar</th>
                <th>Stok Saat Ini</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($ringkasanStok as $index => $stok)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stok->nama_barang }}</td>
                    <td>{{ $stok->total_masuk }}</td>
                    <td>{{ $stok->total_keluar }}</td>
                    <td>
                        <strong style="color: #D96C9D;">
                            {{ $stok->stock }}
                        </strong>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #888;">
                        Belum ada data barang.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- RIWAYAT KARTU STOK --}}
    <h2 style="color: #49313D; margin-bottom: 8px;">
        Riwayat Pergerakan Stok
    </h2>

    <p style="color: #888; margin-bottom: 20px;">
        Catatan setiap transaksi yang memengaruhi persediaan barang.
    </p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Jenis Transaksi</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Saldo Stok</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($kartuStok as $index => $stok)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stok->created_at }}</td>
                    <td>{{ $stok->nama_barang }}</td>
                    <td>
                        @if ($stok->jenis_transaksi == 'P')
                            <span style="color: #219653; font-weight: bold;">
                                Penerimaan
                            </span>
                        @elseif ($stok->jenis_transaksi == 'J')
                            <span style="color: #D96C9D; font-weight: bold;">
                                Penjualan
                            </span>
                        @else
                            {{ $stok->jenis_transaksi }}
                        @endif
                    </td>
                    <td>{{ $stok->masuk }}</td>
                    <td>{{ $stok->keluar }}</td>
                    <td>{{ $stok->stock }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #888;">
                        Belum ada riwayat kartu stok.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection


@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

<div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1>Penjualan</h1>
        <p>Kelola transaksi penjualan barang Bloomify.</p>
    </div>

    <a href="{{ route('penjualan.create') }}"
        style="background: #D96C9D;
                color: white;
                padding: 12px 20px;
                border-radius: 8px;
                text-decoration: none;
                font-weight: bold;">
        + Tambah Penjualan
    </a>
</div>

<div class="content">

    <h2 style="color: #49313D; margin-bottom: 8px;">
        Riwayat Penjualan
    </h2>

    <p style="color: #888; margin-bottom: 25px;">
        Daftar seluruh transaksi penjualan yang telah dilakukan.
    </p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Penjualan</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Subtotal</th>
                <th>PPN (%)</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($penjualan as $index => $transaksi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaksi->idpenjualan }}</td>
                    <td>{{ $transaksi->created_at }}</td>
                    <td>{{ $transaksi->username ?? '-' }}</td>
                    <td>Rp{{ number_format($transaksi->subtotal_nilai ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $transaksi->ppn ?? 0 }}%</td>
                    <td>
                        <strong style="color: #D96C9D;">
                            Rp{{ number_format($transaksi->total_nilai ?? 0, 0, ',', '.') }}
                        </strong>
                    </td>
                    <td>
                        <a href="{{ route('penjualan.detail', $transaksi->idpenjualan) }}"
                        style="background: #F4B6CE;
                                color: #49313D;
                                padding: 8px 14px;
                                border-radius: 6px;
                                text-decoration: none;">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #888;">
                        Belum ada transaksi penjualan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection

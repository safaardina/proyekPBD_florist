
@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

<div class="page-header">
    <h1>Detail Penjualan</h1>
    <p>Informasi lengkap transaksi penjualan Bloomify.</p>
</div>

<div class="content">

    <div style="margin-bottom: 25px;">
        <h3 style="color: #49313D;">Informasi Transaksi</h3>

        <p>ID Penjualan: <strong>{{ $transaksi->idpenjualan }}</strong></p>
        <p>Tanggal: {{ $transaksi->created_at }}</p>
        <p>Kasir: {{ $transaksi->username ?? '-' }}</p>
        <p>Margin Penjualan: {{ $transaksi->margin ?? 0 }}%</p>
    </div>

    <h3 style="color: #49313D;">Daftar Barang</h3>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($detail as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>
                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 25px; text-align: right; line-height: 2;">
        <p>
            Subtotal:
            <strong>Rp{{ number_format($transaksi->subtotal_nilai, 0, ',', '.') }}</strong>
        </p>

        <p>
            PPN ({{ $transaksi->ppn }}%):
            <strong>
                Rp{{ number_format(
                    $transaksi->subtotal_nilai * $transaksi->ppn / 100,
                    0, ',', '.'
                ) }}
            </strong>
        </p>

        <h3 style="color: #D96C9D;">
            Total:
            Rp{{ number_format($transaksi->total_nilai, 0, ',', '.') }}
        </h3>
    </div>

    <a href="{{ route('penjualan.index') }}"
        style="display: inline-block; margin-top: 20px; padding: 10px 20px;
                background: #F4B6CE; color: #49313D; border-radius: 8px;
                text-decoration: none;">
        Kembali
    </a>

</div>

@endsection

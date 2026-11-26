
@extends('layouts.app')

@section('content')

<div style="padding: 30px;">

    <h2 style="color: #49313D; margin-bottom: 8px;">
        Detail Penerimaan Barang
    </h2>

    <p style="color: #888; margin-bottom: 25px;">
        Kelola penerimaan barang berdasarkan pengadaan.
    </p>

    <div style="background: white; padding: 25px; border-radius: 10px; margin-bottom: 25px;">

        <h3 style="color: #49313D; margin-bottom: 15px;">
            Informasi Penerimaan
        </h3>

        <p><strong>ID Penerimaan:</strong> {{ $penerimaan->idpenerimaan }}</p>
        <p><strong>ID Pengadaan:</strong> {{ $penerimaan->idpengadaan }}</p>
        <p><strong>Vendor:</strong> {{ $penerimaan->nama_vendor }}</p>
        <p><strong>Tanggal:</strong> {{ $penerimaan->created_at }}</p>
        <p>
            <strong>Status:</strong>
            @if ($penerimaan->status == 'B')
                Belum Diproses
            @elseif ($penerimaan->status == 'P')
                Dalam Proses
            @elseif ($penerimaan->status == 'S')
                Selesai
            @endif
        </p>

    </div>

    <div style="background: white; padding: 25px; border-radius: 10px;">

        <h3 style="color: #49313D; margin-bottom: 20px;">
            Daftar Barang
        </h3>

        <form action="/penerimaan/{{ $penerimaan->idpenerimaan }}/terima" method="POST">
            @csrf
        <table width="100%" cellpadding="12" cellspacing="0"
            style="border-collapse: collapse;">

            <thead style="background: #D96C9D; color: white;">
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Pesan</th>
                    <th>Sudah Diterima</th>
                    <th>Sisa</th>
                    <th>Jumlah Diterima Sekarang</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($detailBarang as $index => $barang)
                    <tr style="border-bottom: 1px solid #eee; text-align: center;">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->jumlah_pesan }}</td>
                        <td>{{ $barang->jumlah_diterima }}</td>
                        <td>
                        <input
                            type="number"
                            name="jumlah_terima[{{ $barang->idbarang }}]"
                            min="0"
                            max="{{ $barang->sisa }}"
                            value="0"
                            style="width: 90px; padding: 8px; border: 1px solid #ddd; border-radius: 5px;"
                            {{ $barang->sisa <= 0 ? 'disabled' : '' }}
                        >
                    </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">
                            Tidak ada detail barang.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <button type="submit"
            style="margin-top: 20px; background: #D96C9D; color: white;
            border: none; padding: 10px 18px; border-radius: 6px;
            cursor: pointer;">
            Simpan Penerimaan
        </button>

        </form>
    </div>

    <a href="/penerimaan"
        style="display: inline-block; margin-top: 20px; background: #D96C9D;
        color: white; padding: 10px 18px; border-radius: 6px;
        text-decoration: none;">
        Kembali
    </a>

</div>

@endsection

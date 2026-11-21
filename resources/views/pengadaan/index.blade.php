@extends('layouts.app')

@section('content')
<div style="padding: 25px;">

    <h2>Data Pengadaan</h2>
    <a href="/pengadaan/create"
        style="display: inline-block;
            padding: 10px 15px;
            background-color: #273469;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 15px;">
        + Tambah Pengadaan
    </a>

    <p>Daftar transaksi pengadaan barang.</p>

    <table border="1" cellpadding="10" cellspacing="0"
            style="width: 100%; border-collapse: collapse;">

        <thead style="background-color: #273469; color: white;">
            <tr>
                <th>ID Pengadaan</th>
                <th>Data Pengadaan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($pengadaan as $p)
                <tr>
                    <td>{{ $p->idpengadaan }}</td>
                    <td>Data pengadaan #{{ $p->idpengadaan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align: center;">
                        Belum ada data pengadaan.
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>
@endsection

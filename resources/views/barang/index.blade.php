@extends('layouts.app')

@section('title', 'Manajemen Barang')

@section('content')

<div class="page-header">
    <h1>Manajemen Barang</h1>
    <p>Kelola data barang pada sistem Bloomify.</p>
</div>

<div class="content">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Data Barang</h2>

        <a href="/barang/create"
            style="background-color: #273469; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            + Tambah Barang
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Barang</th>
                <th>Jenis</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Status</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($barang as $item)
                <tr>
                    <td>{{ $item->idbarang }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nama_satuan }}</td>
                    <td>{{ $item->status }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td style="display: flex; gap: 8px; align-items: center;">
                        <a href="/barang/{{ $item->idbarang }}/edit"
                        style="background-color: #273469; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none;">
                            Edit
                        </a>

                        <form action="/barang/{{ $item->idbarang }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    style="background-color: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 6px; cursor: pointer;">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

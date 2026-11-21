@extends('layouts.app')

@section('title', 'Manajemen Margin Penjualan')

@section('content')

<div class="page-header">
    <h1>Manajemen Margin Penjualan</h1>
    <p>Kelola persentase margin penjualan pada sistem Bloomify.</p>
</div>

<div class="content">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Data Margin Penjualan</h2>

    <a href="/margin-penjualan/create"
        style="background-color: #273469; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
        + Tambah Margin
    </a>
</div>

    <table>
        <thead>
            <tr>
                <th>ID Margin</th>
                <th>Persentase</th>
                <th>Status</th>
                <th>Dibuat Oleh</th>
                <th>Tanggal Dibuat</th>
                <th>Tanggal Diubah</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($margin as $item)
                <tr>
                    <td>{{ $item->idmargin_penjualan }}</td>
                    <td>{{ $item->persen }}%</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->dibuat_oleh }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td style="display: flex; gap: 8px; align-items: center;">
                    <a href="/margin-penjualan/{{ $item->idmargin_penjualan }}/edit"
                    style="background-color: #273469; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none;">
                        Edit
                    </a>

                    <form action="/margin-penjualan/{{ $item->idmargin_penjualan }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus margin ini?')">
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

@extends('layouts.app')

@section('title', 'Manajemen Satuan')

@section('content')

    <div class="page-header">
        <h1>Manajemen Satuan</h1>
        <p>Kelola data satuan barang pada sistem Bloomify.</p>
    </div>

    <div class="content">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Data Satuan</h2>

            <a href="/satuan/create"
                style="background-color: #273469; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
                + Tambah Satuan
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID Satuan</th>
                    <th>Nama Satuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($satuan as $item)
                    <tr>
                        <td>{{ $item->idsatuan }}</td>
                        <td>{{ $item->nama_satuan }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center;">

                                <a href="/satuan/{{ $item->idsatuan }}/edit"
                                style="background-color: #e9b949; color: #333; padding: 6px 12px; border-radius: 6px; text-decoration: none;">
                                    Edit
                                </a>

                                <form action="/satuan/{{ $item->idsatuan }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus satuan ini?')"
                                        style="background-color: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 6px; cursor: pointer;">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection

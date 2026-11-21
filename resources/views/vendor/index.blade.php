@extends('layouts.app')

@section('title', 'Manajemen Vendor')

@section('content')

    <div class="page-header">
        <h1>Manajemen Vendor</h1>
        <p>Kelola data vendor pada sistem Bloomify.</p>
    </div>

    <div class="content">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Data Vendor</h2>

            <a href="/vendor/create"
                style="background-color: #273469; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
                + Tambah Vendor
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID Vendor</th>
                    <th>Nama Vendor</th>
                    <th>Badan Hukum</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($vendor as $item)
                    <tr>
                        <td>{{ $item->idvendor }}</td>
                        <td>{{ $item->nama_vendor }}</td>
                        <td>{{ $item->badan_hukum }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center;">

                                <a href="/vendor/{{ $item->idvendor }}/edit"
                                style="background-color: #e9b949; color: #333; padding: 6px 12px; border-radius: 6px; text-decoration: none;">
                                    Edit
                                </a>

                                <form action="/vendor/{{ $item->idvendor }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus vendor ini?')"
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

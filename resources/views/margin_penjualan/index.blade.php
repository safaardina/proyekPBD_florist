@extends('layouts.app')

@section('title', 'Manajemen Margin Penjualan')

@section('content')

<div class="page-header">
    <h1>Manajemen Margin Penjualan</h1>
    <p>Kelola persentase margin penjualan pada sistem Bloomify.</p>
</div>

<div class="content">
    @if (session('success'))
    <div style="background-color: #d1fae5; color: #065f46; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="background-color: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif

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
                    <td>
                        @if ($item->status == 1)
                            <span style="background-color: #d1fae5; color: #065f46; padding: 5px 10px; border-radius: 6px;">
                                Aktif
                            </span>
                        @else
                            <span style="background-color: #fee2e2; color: #991b1b; padding: 5px 10px; border-radius: 6px;">
                                Tidak Aktif
                            </span>
                        @endif
                    </td>
                    <td>{{ $item->dibuat_oleh }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td style="display: flex; gap: 8px; align-items: center;">
                                        @if ($item->status != 1)
                        <form action="/margin-penjualan/{{ $item->idmargin_penjualan }}/aktifkan" method="POST"
                            onsubmit="return confirm('Yakin ingin mengaktifkan margin ini?')">
                            @csrf

                            <button type="submit"
                                style="background-color: #198754; color: white; padding: 6px 12px; border: none; border-radius: 6px; cursor: pointer;">
                                Aktifkan
                            </button>
                        </form>
                    @endif

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

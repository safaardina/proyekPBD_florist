@extends('layouts.app')
@section('title', 'Tambah Satuan')
@section('content')

<div class="page-header">
    <h1>Tambah Satuan</h1>
    <p>Tambahkan satuan barang baru pada sistem Bloomify.</p>
</div>

<div class="content">
    <form action="/satuan" method="POST">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="nama_satuan" style="display: block; margin-bottom: 8px;">
                Nama Satuan
            </label>
            <input
                type="text"
                id="nama_satuan"
                name="nama_satuan"
                placeholder="Masukkan nama satuan"
                required
                style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px;"
            >
        </div>

        <div style="margin-bottom: 20px;">
            <label for="status" style="display: block; margin-bottom: 8px;">
                Status
            </label>

            <select
                id="status"
                name="status"
                required
                style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px;"
            >
                <option value="">-- Pilih Status --</option>
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>

        <div style="display: flex; gap: 10px;">
            <button
                type="submit"
                style="background-color: #273469; color: white; padding: 10px 18px; border: none; border-radius: 8px; cursor: pointer;"
            >
                Simpan
            </button>

            <a
                href="/satuan"
                style="background-color: #ddd; color: #333; padding: 10px 18px; border-radius: 8px; text-decoration: none;"
            >
                Batal
            </a>
        </div>

    </form>

</div>

@endsection

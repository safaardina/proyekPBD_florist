@extends('layouts.app')
@section('title', 'Edit Satuan')
@section('content')

<div class="page-header">
    <h1>Edit Satuan</h1>
    <p>Ubah data satuan barang pada sistem Bloomify.</p>
</div>

<div class="content">

    <form action="/satuan/{{ $satuan[0]->idsatuan }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label for="nama_satuan" style="display: block; margin-bottom: 8px;">
                Nama Satuan
            </label>

            <input
                type="text"
                id="nama_satuan"
                name="nama_satuan"
                value="{{ $satuan[0]->nama_satuan }}"
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
                <option value="1" {{ $satuan[0]->status == 1 ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="0" {{ $satuan[0]->status == 0 ? 'selected' : '' }}>
                    Tidak Aktif
                </option>
            </select>
        </div>

        <div style="display: flex; gap: 10px;">
            <button
                type="submit"
                style="background-color: #273469; color: white; padding: 10px 18px; border: none; border-radius: 8px; cursor: pointer;"
            >
                Simpan Perubahan
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

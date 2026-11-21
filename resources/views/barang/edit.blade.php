@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

<div class="page-header">
    <h1>Edit Barang</h1>
    <p>Ubah data barang pada sistem Bloomify.</p>
</div>

<div class="content">

    <h2>Form Edit Barang</h2>

    <form action="/barang/{{ $barang[0]->idbarang }}" method="POST">

        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label>Jenis Barang</label>

            <select name="jenis" required
                    style="width: 100%; padding: 10px;">

                <option value="B" {{ $barang[0]->jenis == 'B' ? 'selected' : '' }}>
                    Bucket
                </option>

                <option value="A" {{ $barang[0]->jenis == 'A' ? 'selected' : '' }}>
                    Satu Tangkai
                </option>

                <option value="C" {{ $barang[0]->jenis == 'C' ? 'selected' : '' }}>
                    Lainnya
                </option>

            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Nama Barang</label>

            <input type="text"
                    name="nama"
                    value="{{ $barang[0]->nama }}"
                    required
                    style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Satuan</label>

            <select name="idsatuan" required
                    style="width: 100%; padding: 10px;">

                @foreach ($satuan as $item)
                    <option value="{{ $item->idsatuan }}"
                        {{ $barang[0]->idsatuan == $item->idsatuan ? 'selected' : '' }}>
                        {{ $item->nama_satuan }}
                    </option>
                @endforeach

            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Status</label>

            <select name="status" required
                    style="width: 100%; padding: 10px;">

                <option value="1" {{ $barang[0]->status == 1 ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="0" {{ $barang[0]->status == 0 ? 'selected' : '' }}>
                    Tidak Aktif
                </option>

            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Harga</label>

            <input type="number"
                    name="harga"
                    value="{{ $barang[0]->harga }}"
                    min="0"
                    required
                    style="width: 100%; padding: 10px;">
        </div>

        <button type="submit"
                style="background-color: #273469; color: white; padding: 10px 16px; border: none; border-radius: 8px;">
            Simpan Perubahan
        </button>

        <a href="/barang"
            style="background-color: gray; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            Batal
        </a>

    </form>

</div>

@endsection

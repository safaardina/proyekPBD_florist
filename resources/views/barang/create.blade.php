@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')

<div class="page-header">
    <h1>Tambah Barang</h1>
    <p>Tambahkan barang baru ke sistem Bloomify.</p>
</div>

<div class="content">

    <h2>Form Tambah Barang</h2>

    <form action="/barang" method="POST">

        @csrf

        <div style="margin-bottom: 15px;">
            <label>Jenis Barang</label>

            <select name="jenis" required
                    style="width: 100%; padding: 10px;">

                <option value="">-- Pilih Jenis --</option>
                <option value="B">Bucket</option>
                <option value="A">Satu Tangkai</option>
                <option value="C">Lainnya</option>

            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Nama Barang</label>

            <input type="text"
                    name="nama"
                    required
                    style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Satuan</label>

            <select name="idsatuan" required
                    style="width: 100%; padding: 10px;">

                <option value="">-- Pilih Satuan --</option>

                @foreach ($satuan as $item)
                    <option value="{{ $item->idsatuan }}">
                        {{ $item->nama_satuan }}
                    </option>
                @endforeach

            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Status</label>

            <select name="status" required
                    style="width: 100%; padding: 10px;">

                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>

            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Harga</label>

            <input type="number"
                    name="harga"
                    min="0"
                    required
                    style="width: 100%; padding: 10px;">
        </div>

        <button type="submit"
                style="background-color: #273469; color: white; padding: 10px 16px; border: none; border-radius: 8px;">
            Simpan
        </button>

        <a href="/barang"
            style="background-color: gray; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            Batal
        </a>

    </form>

</div>

@endsection

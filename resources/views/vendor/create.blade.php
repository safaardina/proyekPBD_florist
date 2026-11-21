@extends('layouts.app')
@section('title', 'Tambah Vendor')
@section('content')

    <div class="page-header">
        <h1>Tambah Vendor</h1>
        <p>Tambahkan vendor baru pada sistem Bloomify.</p>
    </div>

    <div class="content">

        <form action="/vendor" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="nama_vendor" style="display: block; margin-bottom: 8px;">
                    Nama Vendor
                </label>

                <input type="text"
                    id="nama_vendor"
                    name="nama_vendor"
                    placeholder="Masukkan nama vendor"
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="badan_hukum" style="display: block; margin-bottom: 8px;">
                    Badan Hukum
                </label>

                <select id="badan_hukum"
                    name="badan_hukum"
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px;">

                    <option value="">-- Pilih Badan Hukum --</option>
                    <option value="P">Perorangan</option>
                    <option value="C">CV</option>
                    <option value="L">PT</option>

                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="status" style="display: block; margin-bottom: 8px;">
                    Status
                </label>

                <select id="status"
                    name="status"
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px;">

                    <option value="">-- Pilih Status --</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>

                </select>
            </div>

            <div style="display: flex; gap: 10px;">

                <button type="submit"
                    style="background-color: #273469; color: white; padding: 10px 18px; border: none; border-radius: 8px; cursor: pointer;">
                    Simpan
                </button>

                <a href="/vendor"
                    style="background-color: #ddd; color: #333; padding: 10px 18px; border-radius: 8px; text-decoration: none;">
                    Batal
                </a>

            </div>

        </form>

    </div>

@endsection

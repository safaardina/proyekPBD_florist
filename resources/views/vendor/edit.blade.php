@extends('layouts.app')

@section('title', 'Edit Vendor')

@section('content')

<div class="page-header">
    <h1>Edit Vendor</h1>
    <p>Ubah data vendor pada sistem Bloomify.</p>
</div>

<div class="content">

    <h2>Form Edit Vendor</h2>

    <form action="/vendor/{{ $vendor[0]->idvendor }}" method="POST">

        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label>Nama Vendor</label>
            <input type="text"
                    name="nama_vendor"
                    value="{{ $vendor[0]->nama_vendor }}"
                    required
                    style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Badan Hukum</label>

            <select name="badan_hukum" required
                    style="width: 100%; padding: 10px;">

                <option value="P"
                    {{ $vendor[0]->badan_hukum == 'P' ? 'selected' : '' }}>
                    Perorangan
                </option>

                <option value="C"
                    {{ $vendor[0]->badan_hukum == 'C' ? 'selected' : '' }}>
                    CV
                </option>

                <option value="L"
                    {{ $vendor[0]->badan_hukum == 'L' ? 'selected' : '' }}>
                    PT
                </option>

            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Status</label>

            <select name="status" required
                    style="width: 100%; padding: 10px;">

                <option value="1"
                    {{ $vendor[0]->status == 1 ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="0"
                    {{ $vendor[0]->status == 0 ? 'selected' : '' }}>
                    Tidak Aktif
                </option>

            </select>
        </div>

        <button type="submit"
                style="background-color: #273469; color: white; padding: 10px 16px; border: none; border-radius: 8px;">
            Simpan Perubahan
        </button>

        <a href="/vendor"
            style="background-color: gray; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            Batal
        </a>

    </form>

</div>

@endsection

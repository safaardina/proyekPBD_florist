@extends('layouts.app')

@section('title', 'Tambah Margin Penjualan')

@section('content')

<div class="page-header">
    <h1>Tambah Margin Penjualan</h1>
    <p>Tambahkan persentase margin penjualan baru.</p>
</div>

<div class="content">

    <form action="/margin-penjualan" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Persentase Margin</label>
            <input type="number" name="persen" min="0" max="100"
                    required style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Status</label>
            <select name="status" required style="width: 100%; padding: 10px;">
                <option value="1">Aktif</option>
                <option value="0">Tidak Aktif</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Dibuat Oleh</label>
            <select name="iduser" required style="width: 100%; padding: 10px;">
                <option value="">-- Pilih User --</option>

                @foreach ($user as $item)
                    <option value="{{ $item->iduser }}">
                        {{ $item->username }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit"
                style="background-color: #273469; color: white; padding: 10px 16px; border: none; border-radius: 8px;">
            Simpan
        </button>

        <a href="/margin-penjualan"
            style="background-color: #6c757d; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            Batal
        </a>

    </form>

</div>

@endsection

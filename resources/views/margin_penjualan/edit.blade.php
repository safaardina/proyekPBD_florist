@extends('layouts.app')

@section('title', 'Edit Margin Penjualan')

@section('content')

<div class="page-header">
    <h1>Edit Margin Penjualan</h1>
    <p>Ubah data margin penjualan.</p>
</div>

<div class="content">

    <form action="/margin-penjualan/{{ $margin[0]->idmargin_penjualan }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label>Persentase Margin</label>
            <input type="number" name="persen"
                    value="{{ $margin[0]->persen }}"
                    min="0" max="100"
                    required style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Status</label>
            <select name="status" required style="width: 100%; padding: 10px;">
                <option value="1" {{ $margin[0]->status == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $margin[0]->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Dibuat Oleh</label>
            <select name="iduser" required style="width: 100%; padding: 10px;">
                @foreach ($user as $item)
                    <option value="{{ $item->iduser }}"
                        {{ $item->iduser == $margin[0]->iduser ? 'selected' : '' }}>
                        {{ $item->username }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit"
                style="background-color: #273469; color: white; padding: 10px 16px; border: none; border-radius: 8px;">
            Simpan Perubahan
        </button>

        <a href="/margin-penjualan"
            style="background-color: #6c757d; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            Batal
        </a>

    </form>

</div>

@endsection

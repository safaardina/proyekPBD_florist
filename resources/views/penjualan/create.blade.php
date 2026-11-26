
@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')

<div class="page-header">
    <h1>Tambah Penjualan</h1>
    <p>Masukkan barang yang dibeli oleh pelanggan.</p>
</div>

<div class="content">
@if (session('success'))
    <div style="background: #e8f8ed; color: #267a45; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="background: #fdecef; color: #b42345; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div style="background: #fdecef; color: #b42345; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

    <form action="{{ route('penjualan.store') }}" method="POST">
    @csrf

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                Margin Penjualan Aktif
            </label>

            @if ($marginAktif)
                <input
                    type="text"
                    value="{{ $marginAktif->persen }}%"
                    readonly
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;"
                >
            @else
                <p style="color: red;">Belum ada margin penjualan yang aktif.</p>
            @endif
        </div>

        <h3 style="color: #49313D; margin-bottom: 15px;">
            Pilih Barang
        </h3>

        @if (count($barang) > 0)

            @foreach ($barang as $item)
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; align-items: center; margin-bottom: 15px; padding: 15px; border: 1px solid #eee; border-radius: 8px;">

                    <div>
                        <strong>{{ $item->nama }}</strong>
                        <p style="color: #888; margin: 5px 0;">
                            Harga modal: Rp{{ number_format($item->harga_modal, 0, ',', '.') }}
                        </p>

                        <p style="color: #D96C9D; margin: 5px 0;">
                            Harga jual:
                            <strong>
                                Rp{{ number_format($item->harga_jual, 0, ',', '.') }}
                            </strong>
                        </p>
                    </div>

                    <div>
                        <span>Stok: {{ $item->stock }}</span>
                    </div>

                    <div>
                        <label>Jumlah</label>
                        <input
                            type="number"
                            name="jumlah[{{ $item->idbarang }}]"
                            min="0"
                            max="{{ $item->stock }}"
                            value="0"
                            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px;"
                        >
                    </div>

                </div>
            @endforeach

        @else
            <p style="color: #888;">Belum ada barang yang memiliki stok tersedia.</p>
        @endif

        <div style="margin-top: 25px; display: flex; justify-content: flex-end;">
    <button
        type="submit"
        style="background: #D96C9D; color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; font-weight: bold;"
    >
        Simpan Penjualan
    </button>
</div>


    </form>

</div>

@endsection

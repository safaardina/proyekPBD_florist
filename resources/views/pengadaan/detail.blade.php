@extends('layouts.app')

@section('content')

<div style="padding: 30px;">

    <h2 style="color: #273469; margin-bottom: 8px;">
        Tambah Barang Pengadaan
    </h2>

    <p style="color: #777; margin-bottom: 25px;">
        Masukkan barang yang dibeli pada transaksi pengadaan ini.
    </p>

    <div style="background: white;
                padding: 30px;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.08);
                max-width: 700px;">

        <form action="/pengadaan/detail" method="POST">
            @csrf

            <input type="hidden" name="idpengadaan"
                    value="{{ $pengadaan[0]->idpengadaan }}">

            <div style="margin-bottom: 20px;">
                <label style="font-weight: bold;">Barang</label>

                <select name="idbarang" required
                    style="width: 100%; padding: 12px; margin-top: 8px;
                    border: 1px solid #ddd; border-radius: 6px;">

                    <option value="">Pilih Barang</option>

                    @foreach ($barang as $b)
                        <option value="{{ $b->idbarang }}">
                            {{ $b->nama }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: bold;">Harga Satuan</label>

                <input type="number" name="harga_satuan"
                        min="1" required
                        placeholder="Masukkan harga satuan"
                        style="width: 100%; padding: 12px; margin-top: 8px;
                        border: 1px solid #ddd; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="font-weight: bold;">Jumlah</label>

                <input type="number" name="jumlah"
                        min="1" required
                        placeholder="Masukkan jumlah barang"
                        style="width: 100%; padding: 12px; margin-top: 8px;
                        border: 1px solid #ddd; border-radius: 6px;">
            </div>

            <button type="submit"
                style="padding: 12px 22px;
                        background: #273469;
                        color: white;
                        border: none;
                        border-radius: 6px;
                        cursor: pointer;">
                Simpan Barang
            </button>

            <a href="/pengadaan"
                style="padding: 12px 22px;
                        background: #eee;
                        color: #333;
                        text-decoration: none;
                        border-radius: 6px;
                        margin-left: 8px;">
                Kembali
            </a>

        </form>

    </div>
<div style="margin-top: 30px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);">

    <h3 style="color: #273469; margin-bottom: 20px;">
        Detail Barang Pengadaan
    </h3>

    <table width="100%" cellpadding="12" cellspacing="0"
            style="border-collapse: collapse;">

        <thead style="background: #273469; color: white;">
            <tr>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($detail as $d)
                <tr style="border-bottom: 1px solid #eee;">
                    <td>{{ $d->nama }}</td>
                    <td>Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td>Rp {{ number_format($d->sub_total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 25px;">
                        Belum ada barang dalam pengadaan ini.
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>


<div style="margin-top: 25px;
            padding: 20px;
            background: #f4f6fc;
            border-radius: 10px;
            text-align: right;">

    <p style="margin-bottom: 10px;">
        Subtotal:
        <strong>
            Rp {{ number_format($pengadaan[0]->subtotal_nilai, 0, ',', '.') }}
        </strong>
    </p>

    <p style="margin-bottom: 10px;">
        PPN:
        <strong>
            Rp {{ number_format($pengadaan[0]->ppn, 0, ',', '.') }}
        </strong>
    </p>

    <h3 style="color: #273469;">
        Total Pengadaan:
        Rp {{ number_format($pengadaan[0]->total_nilai, 0, ',', '.') }}
    </h3>

</div>

</div>

@endsection

@extends('layouts.app')
@section('content')

<div style="padding: 30px;">
    <h2 style="color: #273469; margin-bottom: 8px;">
        Pengadaan
    </h2>
    <p style="color: #777; margin-bottom: 25px;">
        Kelola transaksi pengadaan dan riwayat pembelian barang.
    </p>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div style="background: #d4edda; color: #155724;
                    padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background: #f8d7da; color: #721c24;
                    padding: 12px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    {{-- FORM PENGADAAN BARU --}}
    <div style="background: white; padding: 25px;
                border-radius: 12px; margin-bottom: 25px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.08);">

        <h3 style="color: #273469; margin-bottom: 20px;">
            Buat Pengadaan Baru
        </h3>

        <form action="/pengadaan" method="POST">
            @csrf

            <div style="display: flex; gap: 20px; flex-wrap: wrap;">

                <div style="flex: 1; min-width: 200px;">
                    <label><strong>Vendor</strong></label>
                    <select name="idvendor" required
                        style="width: 100%; padding: 12px; margin-top: 8px;
                                border: 1px solid #ddd; border-radius: 6px;">
                        <option value="">Pilih Vendor</option>
                        @foreach ($vendor as $v)
                            <option value="{{ $v->idvendor }}">
                                {{ $v->nama_vendor }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="flex: 1; min-width: 200px;">
                    <label><strong>Tanggal Pengadaan</strong></label>
                    <input type="date" name="tanggal" required
                        style="width: 100%; padding: 12px; margin-top: 8px;
                                border: 1px solid #ddd; border-radius: 6px;">
                </div>

                <div style="flex: 1; min-width: 200px;">
                    <label><strong>Petugas</strong></label>
                    <select name="iduser" required
                        style="width: 100%; padding: 12px; margin-top: 8px;
                                border: 1px solid #ddd; border-radius: 6px;">
                        <option value="">Pilih Petugas</option>
                        @foreach ($user as $u)
                            <option value="{{ $u->iduser }}">
                                {{ $u->username }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <button type="submit"
                style="margin-top: 20px; padding: 12px 22px;
                        background: #273469; color: white;
                        border: none; border-radius: 6px; cursor: pointer;">
                + Buat Draft Pengadaan
            </button>

        </form>
    </div>


    {{-- DETAIL PENGADAAN AKTIF --}}
    @if ($pengadaanAktif)

        <div style="background: white; padding: 25px;
                    border-radius: 12px; margin-bottom: 25px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.08);">

            <h3 style="color: #273469; margin-bottom: 8px;">
                Detail Pengadaan #{{ $pengadaanAktif->idpengadaan }}
            </h3>

            <p style="color: #777; margin-bottom: 20px;">
                Tambahkan barang ke dalam transaksi pengadaan.
            </p>

            @if ($pengadaanAktif->status == 'D')

                <form action="/pengadaan/detail" method="POST">
                    @csrf

                    <input type="hidden" name="idpengadaan"
                            value="{{ $pengadaanAktif->idpengadaan }}">

                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">

                        <div style="flex: 2; min-width: 200px;">
                            <label><strong>Barang</strong></label>
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

                        <div style="flex: 1; min-width: 150px;">
                            <label><strong>Harga Satuan</strong></label>
                            <input type="number" name="harga_satuan"
                                    min="1" required placeholder="Harga"
                                style="width: 100%; padding: 12px; margin-top: 8px;
                                        border: 1px solid #ddd; border-radius: 6px;">
                        </div>

                        <div style="flex: 1; min-width: 120px;">
                            <label><strong>Jumlah</strong></label>
                            <input type="number" name="jumlah"
                                    min="1" required placeholder="Jumlah"
                                style="width: 100%; padding: 12px; margin-top: 8px;
                                        border: 1px solid #ddd; border-radius: 6px;">
                        </div>

                    </div>

                    <button type="submit"
                        style="margin-top: 18px; padding: 12px 22px;
                                background: #273469; color: white;
                                border: none; border-radius: 6px; cursor: pointer;">
                        + Tambahkan Barang
                    </button>

                </form>

            @else

                <p style="color: #198754; margin-bottom: 20px;">
                    Pengadaan sudah dikonfirmasi. Detail barang tidak dapat ditambahkan.
                </p>

            @endif

            {{-- TABEL DETAIL BARANG --}}
            <h4 style="color: #273469; margin-top: 30px; margin-bottom: 15px;">
                Daftar Barang Pengadaan
            </h4>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">

                    <thead>
                        <tr style="background: #273469; color: white;">
                            <th style="padding: 12px;">No</th>
                            <th style="padding: 12px; text-align: left;">Nama Barang</th>
                            <th style="padding: 12px; text-align: right;">Harga Satuan</th>
                            <th style="padding: 12px;">Jumlah</th>
                            <th style="padding: 12px; text-align: right;">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($detail as $index => $d)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 12px; text-align: center;">
                                    {{ $index + 1 }}
                                </td>
                                <td style="padding: 12px;">
                                    {{ $d->nama }}
                                </td>
                                <td style="padding: 12px; text-align: right;">
                                    Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}
                                </td>
                                <td style="padding: 12px; text-align: center;">
                                    {{ $d->jumlah }}
                                </td>
                                <td style="padding: 12px; text-align: right;">
                                    Rp {{ number_format($d->sub_total, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    style="padding: 25px; text-align: center; color: #888;">
                                    Belum ada barang dalam pengadaan ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{-- RINGKASAN TOTAL --}}
            <div style="margin-top: 25px; padding: 20px;
                        background: #f4f6fc; border-radius: 10px;
                        text-align: right;">

                <p style="margin-bottom: 10px;">
                    Subtotal:
                    <strong>
                        Rp {{ number_format($pengadaanAktif->subtotal_nilai, 0, ',', '.') }}
                    </strong>
                </p>

                <p style="margin-bottom: 10px;">
                    PPN:
                    <strong>
                        Rp {{ number_format($pengadaanAktif->ppn, 0, ',', '.') }}
                    </strong>
                </p>

                <h3 style="color: #273469;">
                    Total Pengadaan:
                    Rp {{ number_format($pengadaanAktif->total_nilai, 0, ',', '.') }}
                </h3>

            </div>

            {{-- KONFIRMASI --}}
            @if ($pengadaanAktif->status == 'D' && count($detail) > 0)

                <form action="/pengadaan/{{ $pengadaanAktif->idpengadaan }}/konfirmasi"
                        method="POST"
                        style="margin-top: 20px; text-align: right;">
                    @csrf

                    <button type="submit"
                        onclick="return confirm('Yakin ingin mengonfirmasi pengadaan ini?')"
                        style="padding: 12px 22px; background: #198754;
                                color: white; border: none; border-radius: 6px;
                                cursor: pointer;">
                        Konfirmasi Pengadaan
                    </button>
                </form>

            @endif

        </div>

    @endif


    {{-- RIWAYAT PENGADAAN --}}
    <div style="background: white; padding: 25px;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.08);">

        <h3 style="color: #273469; margin-bottom: 20px;">
            Riwayat Pengadaan
        </h3>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">

                <thead>
                    <tr style="background: #273469; color: white;">
                        <th style="padding: 13px;">ID</th>
                        <th style="padding: 13px; text-align: left;">Vendor</th>
                        <th style="padding: 13px; text-align: left;">Tanggal</th>
                        <th style="padding: 13px; text-align: left;">Petugas</th>
                        <th style="padding: 13px; text-align: right;">Total</th>
                        <th style="padding: 13px;">Status</th>
                        <th style="padding: 13px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pengadaan as $p)

                        <tr style="border-bottom: 1px solid #eee;">

                            <td style="padding: 13px; text-align: center;">
                                #{{ $p->idpengadaan }}
                            </td>

                            <td style="padding: 13px;">
                                {{ $p->nama_vendor }}
                            </td>

                            <td style="padding: 13px;">
                                {{ $p->tanggal }}
                            </td>

                            <td style="padding: 13px;">
                                {{ $p->username }}
                            </td>

                            <td style="padding: 13px; text-align: right;">
                                Rp {{ number_format($p->total_nilai ?? 0, 0, ',', '.') }}
                            </td>

                            <td style="padding: 13px; text-align: center;">
                                @if ($p->status == 'D')
                                    <span style="background: #fff3cd; color: #856404;
                                                 padding: 6px 10px; border-radius: 6px;">
                                        Draft
                                    </span>
                                @elseif ($p->status == 'C')
                                    <span style="background: #d4edda; color: #155724;
                                                 padding: 6px 10px; border-radius: 6px;">
                                        Confirmed
                                    </span>
                                @else
                                    <span style="color: #777;">Belum ditentukan</span>
                                @endif
                            </td>

                            <td style="padding: 13px; text-align: center;">
                                <a href="/pengadaan?id={{ $p->idpengadaan }}"
                                   style="background: #e8edff; color: #273469;
                                          padding: 8px 14px; text-decoration: none;
                                          border-radius: 6px;">
                                    Detail
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7"
                                style="padding: 25px; text-align: center; color: #888;">
                                Belum ada transaksi pengadaan.
                            </td>
                        </tr>

                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection

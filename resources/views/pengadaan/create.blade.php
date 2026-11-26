@extends('layouts.app')

@section('content')

<div style="padding: 30px;">

    <div style="margin-bottom: 25px;">
        <h2 style="color: #273469; margin-bottom: 8px;">
            Tambah Pengadaan
        </h2>

        <p style="color: #777;">
            Catat pengadaan barang dari vendor.
        </p>
    </div>

    <div style="
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        max-width: 700px;
    ">

        <form action="/pengadaan" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="font-weight: bold;">
                    Vendor
                </label>

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

            <div style="margin-bottom: 20px;">
                <label style="font-weight: bold;">
                    Tanggal Pengadaan
                </label>

                <input type="date" name="tanggal" required
                    style="width: 100%; padding: 12px; margin-top: 8px;
                    border: 1px solid #ddd; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="font-weight: bold;">
                    Petugas
                </label>

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

            <div style="display: flex; gap: 10px;">

                <button type="submit"
                    style="padding: 12px 22px;
                    background: #273469;
                    color: white;
                    border: none;
                    border-radius: 6px;
                    cursor: pointer;">
                    Simpan Pengadaan
                </button>

                <a href="/pengadaan"
                    style="padding: 12px 22px;
                    background: #eee;
                    color: #333;
                    text-decoration: none;
                    border-radius: 6px;">
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

@endsection

@extends('layouts.app')

@section('title', 'Tambah Role')

@section('content')

    <div class="page-header">
        <h1>Tambah Role</h1>
        <p>Tambahkan role baru untuk pengguna Bloomify.</p>
    </div>

    <div class="content">

        <form action="/role" method="POST">

            @csrf

            <div style="margin-bottom: 20px;">

                <label for="nama_role" style="display: block; margin-bottom: 8px;">
                    Nama Role
                </label>

                <input
                    type="text"
                    id="nama_role"
                    name="nama_role"
                    placeholder="Masukkan nama role"
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px;"
                >

            </div>

            <div style="display: flex; gap: 10px;">

                <button
                    type="submit"
                    style="background-color: #273469; color: white; padding: 10px 18px; border: none; border-radius: 8px; cursor: pointer;">
                    Simpan
                </button>

                <a
                    href="/role"
                    style="background-color: #ddd; color: #333; padding: 10px 18px; border-radius: 8px; text-decoration: none;">
                    Batal
                </a>

            </div>

        </form>

    </div>

@endsection

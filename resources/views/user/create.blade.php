@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="page-header">
    <h1>Tambah User</h1>
    <p>Tambahkan pengguna baru ke sistem Bloomify.</p>
</div>

<div class="content">

    <h2>Form Tambah User</h2>

    <form action="/user" method="POST">

        @csrf

        <div style="margin-bottom: 15px;">
            <label>Username</label>
            <input type="text"
                    name="username"
                    required
                    style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Password</label>
            <input type="password"
                    name="password"
                    required
                    style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Role</label>

            <select name="idrole" required
                    style="width: 100%; padding: 10px;">

                <option value="">-- Pilih Role --</option>

                @foreach ($role as $item)
                    <option value="{{ $item->idrole }}">
                        {{ $item->nama_role }}
                    </option>
                @endforeach

            </select>
        </div>

        <button type="submit"
                style="background-color: #273469; color: white; padding: 10px 16px; border: none; border-radius: 8px;">
            Simpan
        </button>

        <a href="/user"
            style="background-color: gray; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            Batal
        </a>

    </form>

</div>

@endsection

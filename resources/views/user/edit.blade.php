@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="page-header">
    <h1>Edit User</h1>
    <p>Ubah data pengguna pada sistem Bloomify.</p>
</div>

<div class="content">

    <h2>Form Edit User</h2>

    <form action="/user/{{ $user[0]->iduser }}" method="POST">

        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label>Username</label>
            <input type="text"
                    name="username"
                    value="{{ $user[0]->username }}"
                    required
                    style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Password Baru (opsional)</label>
            <input type="password"
                    name="password"
                    placeholder="Kosongkan jika tidak ingin mengubah password"
                    style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Role</label>

            <select name="idrole" required
                    style="width: 100%; padding: 10px;">

                @foreach ($role as $item)
                    <option value="{{ $item->idrole }}"
                        {{ $user[0]->idrole == $item->idrole ? 'selected' : '' }}>
                        {{ $item->nama_role }}
                    </option>
                @endforeach

            </select>
        </div>

        <button type="submit"
                style="background-color: #273469; color: white; padding: 10px 16px; border: none; border-radius: 8px;">
            Simpan Perubahan
        </button>

        <a href="/user"
            style="background-color: gray; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            Batal
        </a>

    </form>

</div>

@endsection

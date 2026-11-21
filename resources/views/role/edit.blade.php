@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')

<div class="page-header">
    <h1>Edit Role</h1>
    <p>Ubah data role pengguna pada sistem Bloomify.</p>
</div>

<div class="content">

    <form action="/role/{{ $role[0]->idrole }}" method="POST">

        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label for="nama_role" style="display: block; margin-bottom: 8px;">
                Nama Role
            </label>

            <input
                type="text"
                id="nama_role"
                name="nama_role"
                value="{{ $role[0]->nama_role }}"
                required
                style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px;"
            >
        </div>

        <div style="display: flex; gap: 10px;">
            <button
                type="submit"
                style="background-color: #273469; color: white; padding: 10px 18px; border: none; border-radius: 8px; cursor: pointer;"
            >
                Simpan Perubahan
            </button>

            <a
                href="/role"
                style="background-color: #ddd; color: #333; padding: 10px 18px; border-radius: 8px; text-decoration: none;"
            >
                Batal
            </a>
        </div>

    </form>

</div>

@endsection

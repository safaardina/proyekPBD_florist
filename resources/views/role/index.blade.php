@extends('layouts.app')
@section('title', 'Manajemen Role')
@section('active-menu', 'active')
@section('content')

    <div class="page-header">
        <h1>Manajemen Role</h1>
        <p>Kelola data role pengguna pada sistem Bloomify.</p>
    </div>

<div class="content">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">

        <h2>Data Role</h2>

        <a href="/role/create"
            style="background-color: #273469; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            + Tambah Role
        </a>

    </div>

        <table>
            <thead>
                <tr>
                    <th>ID Role</th>
                    <th>Nama Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->idrole }}</td>
                        <td>{{ $role->nama_role }}</td>
                        <td>
                            <a href="/role/{{ $role->idrole }}/edit"
                            style="background-color: #e9b949; color: #333; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                                Edit
                            </a>
                            <form action="/role/{{ $role->idrole }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Apakah kamu yakin ingin menghapus role ini?')"
                                style="background-color: #dc3545; color: white; padding: 8px 12px; border: none; border-radius: 6px; cursor: pointer;">
                                Hapus
                            </button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection

@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')

<div class="page-header">
    <h1>Manajemen User</h1>
    <p>Kelola data pengguna pada sistem Bloomify.</p>
</div>

<div class="content">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Data User</h2>

        <a href="/user/create"
            style="background-color: #273469; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none;">
            + Tambah User
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($user as $item)
                <tr>
                    <td>{{ $item->iduser }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->nama_role }}</td>
                            <td>
                                <div style="display: flex; gap: 8px; align-items: center;">

                                    <a href="/user/{{ $item->iduser }}/edit"
                                    style="background-color: #e9b949; color: #333; padding: 6px 12px; border-radius: 6px; text-decoration: none;">
                                        Edit
                                    </a>

                                    <form action="/user/{{ $item->iduser }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')"
                                            style="background-color: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 6px; cursor: pointer;">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

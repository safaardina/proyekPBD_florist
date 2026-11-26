@extends('layouts.app')
@section('content')

<div style="padding: 30px;">

    <h2 style="color: #273469; margin-bottom: 8px;">
        Penerimaan Barang
    </h2>

    <p style="color: #777; margin-bottom: 25px;">
        Kelola penerimaan barang berdasarkan pengadaan yang telah dikonfirmasi.
    </p>

    {{-- WAITING LIST PENGADAAN --}}
    <div style="background: white; padding: 25px; border-radius: 10px; margin-bottom: 30px;">

        <h3 style="color: #273469; margin-bottom: 20px;">
            Waiting List Pengadaan
        </h3>

        <table width="100%" cellpadding="12" cellspacing="0" style="border-collapse: collapse;">
            <thead style="background: #273469; color: white;">
                <tr>
                    <th>ID Pengadaan</th>
                    <th>Tanggal</th>
                    <th>Vendor</th>
                    <th>Petugas</th>
                    <th>Total Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($waitingList as $item)
                    <tr style="border-bottom: 1px solid #ddd; text-align: center;">
                        <td>{{ $item->idpengadaan }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->nama_vendor }}</td>
                        <td>{{ $item->username }}</td>
                        <td>Rp {{ number_format($item->total_nilai, 0, ',', '.') }}</td>
                        <td>
                            <form action="/penerimaan/{{ $item->idpengadaan }}/proses" method="POST">
                                @csrf

                                <button type="submit"
                                    style="background: #D96C9D; color: white; border: none; padding: 8px 14px; border-radius: 5px; cursor: pointer;">
                                    Proses
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px;">
                            Tidak ada pengadaan yang menunggu penerimaan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    {{-- RIWAYAT PENERIMAAN --}}
    <div style="background: white; padding: 25px; border-radius: 10px;">

        <h3 style="color: #273469; margin-bottom: 20px;">
            Riwayat Penerimaan
        </h3>

        <table width="100%" cellpadding="12" cellspacing="0" style="border-collapse: collapse;">
            <thead style="background: #273469; color: white;">
                <tr>
                    <th>ID Penerimaan</th>
                    <th>ID Pengadaan</th>
                    <th>Vendor</th>
                    <th>Tanggal</th>
                    <th>Petugas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($penerimaan as $item)
                    <tr style="border-bottom: 1px solid #ddd; text-align: center;">
                        <td>{{ $item->idpenerimaan }}</td>
                        <td>{{ $item->idpengadaan }}</td>
                        <td>{{ $item->nama_vendor }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->username }}</td>
                        <td>
                            @if ($item->status == 'B')
                                Belum Diproses
                            @elseif ($item->status == 'P')
                                Dalam Proses
                            @elseif ($item->status == 'S')
                                Selesai
                            @endif
                        </td>
                        <td>
                            <a href="/penerimaan/{{ $item->idpengadaan }}/detail"
                                style="background: #D96C9D; color: white; padding: 8px 14px;
                                border-radius: 5px; text-decoration: none;">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px;">
                            Belum ada riwayat penerimaan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection

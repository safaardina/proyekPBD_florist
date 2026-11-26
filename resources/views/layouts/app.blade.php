<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | Bloomify</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background-color: #D96C9D;
            color: white;
            position: fixed;
            padding: 25px 20px;
        }

        .brand {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .brand-subtitle {
            font-size: 12px;
            color: #cbd3f0;
            margin-bottom: 35px;
        }

        .menu-title {
            font-size: 12px;
            color: #aeb9df;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 6px;
        }

        .menu a:hover,
        .menu a.active {
            background-color: #C65386;
        }

        .menu-transaksi {
            margin-bottom: 6px;
        }

        .menu-transaksi summary {
            display: block;
            color: white;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            list-style: none;
        }

        .menu-transaksi summary::-webkit-details-marker {
            display: none;
        }

        .menu-transaksi summary::after {
            content: "⌄";
            float: right;
        }

        .menu-transaksi[open] summary::after {
            content: "⌃";
        }

        .menu-transaksi summary:hover {
            background-color: #C65386;
        }

        .menu-transaksi a {
            margin-left: 12px;
            font-size: 14px;
            padding: 10px 12px;
        }

        .main-content {
            margin-left: 240px;
            padding: 35px;
        }

        .page-header {
            margin-bottom: 25px;
        }

        .page-header h1 {
            color: #273469;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #777;
        }

        .content {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #273469;
            color: white;
        }

        tr:hover {
            background-color: #f8f9fc;
        }
    </style>
</head>

<body>

    <aside class="sidebar">

        <div class="brand">Bloomify</div>

        <div class="brand-subtitle">
            Florist Management System
        </div>


        <div class="menu">
            <div class="menu-title">Menu Utama</div>

            <a href="/dashboard">Dashboard</a>

            <!-- Dropdown Data Master -->
            <details class="menu-transaksi">
                <summary>Data Master</summary>

                <a href="/role">Manajemen Role</a>
                <a href="/satuan">Manajemen Satuan</a>
                <a href="/vendor">Manajemen Vendor</a>
                <a href="/user">Manajemen User</a>
                <a href="/barang">Manajemen Barang</a>
                <a href="/margin-penjualan">Manajemen Margin Penjualan</a>
            </details>

            <!-- Dropdown Transaksi -->
            <details class="menu-transaksi">
                <summary>Transaksi</summary>

                <a href="/pengadaan">Pengadaan</a>
                <a href="/penerimaan">Penerimaan</a>
                <a href="/penjualan">Penjualan</a>
            </details>

        </div>

        <!-- Dropdown Laporan -->
        <details class="menu-transaksi">
            <summary>Laporan</summary>

            <a href="/kartu-stok">Kartu Stok</a>
        </details>

    </aside>

    <main class="main-content">

        @yield('content')

    </main>

</body>
</html>

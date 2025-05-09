<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Transaksi</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            src: url('{{ storage_path('fonts/DejaVuSans.ttf') }}') format('truetype');
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center">Laporan Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Jumlah</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
            <tr>
                <td>{{ $record['created_at'] }}</td>
                <td>{{ $record['judul'] }}</td>
                <td>{{ $record['jumlah'] }}</td>
                <td>{{ $record['jenis'] }}</td>
                <td>{{ $record['kategori'] }}</td>
                <td>{{ $record['keterangan'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

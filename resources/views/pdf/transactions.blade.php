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
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .meta { margin-bottom: 12px; color: #555; font-size: 11px; }
    </style>
</head>
<body>
    <h2 style="text-align: center; margin-bottom: 4px;">Laporan Transaksi</h2>
    @if(!empty($start) || !empty($end))
        <p class="meta" style="text-align:center;">
            Periode: {{ $start ?? 'awal' }} s.d. {{ $end ?? 'sekarang' }}
        </p>
    @endif
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
                <td>{{ $record['tanggal'] }}</td>
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

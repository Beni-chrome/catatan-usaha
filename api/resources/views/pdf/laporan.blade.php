<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .kop {
            text-align: center;
            border-bottom: 2px solid #222;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .kop h2 {
            margin: 0;
        }

        .kop p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #444;
            padding: 6px;
        }

        table th {
            background: #eee;
        }

        .total {
            margin-top: 15px;
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="kop">
    <h2>{{ $usaha->nama_usaha }}</h2>
    <p>{{ $usaha->alamat }}</p>
    <p>{{ $usaha->telepon }} | {{ $usaha->email }}</p>
    <h3>LAPORAN PENJUALAN</h3>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga Jual</th>
            <th>Total</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->produk->nama ?? '-' }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center;">Tidak ada data</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="total">
    Total: Rp {{ number_format($total, 0, ',', '.') }}
</div>

</body>
</html>

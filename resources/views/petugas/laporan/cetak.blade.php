<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian Alat</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h3 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin: 0;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h3>Laporan Pengembalian Alat</h3>

    @if(isset($tanggal_awal) && isset($tanggal_akhir))
    <p>
        Laporan dari tanggal
        <strong>{{ \Carbon\Carbon::parse($tanggal_awal)->format('d/m/Y') }}</strong>
        sampai
        <strong>{{ \Carbon\Carbon::parse($tanggal_akhir)->format('d/m/Y') }}</strong>
    </p>
    @else
    <p><strong>Menampilkan semua data pengembalian</strong></p>
    @endif

    <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalDenda = 0;
            @endphp

            @foreach($peminjamans as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->alat->nama_alat }}</td>
                <td>{{ $p->jumlah }}</td>
                <td>{{ $p->tanggal_pinjam->format('d-m-Y') }}</td>
                <td>{{ $p->tanggal_kembali->format('d-m-Y') }}</td>
                <td>
                    @if($p->denda > 0)
                    Rp {{ number_format($p->denda, 0, ',', '.') }}
                    @php $totalDenda += $p->denda; @endphp
                    @else
                    -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="6" style="text-align:right;">Total Denda:</td>
                <td>Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
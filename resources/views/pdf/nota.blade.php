<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            border: 1px solid #ddd;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .info {
            margin-top: 20px;
        }

        .info table {
            width: 100%;
        }

        .info td {
            padding: 5px 0;
        }

        .total {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: red;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 15px 0;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="header">
            <div class="title">NOTA PEMBAYARAN DENDA</div>
            <div>Sistem Peminjaman Alat</div>
        </div>

        <div class="line"></div>

        <div class="info">
            <table>
                <tr>
                    <td>Invoice</td>
                    <td>: {{ $invoice }}</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: {{ $peminjaman->user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{ $peminjaman->user->email }}</td>
                </tr>
                <tr>
                    <td>Alat</td>
                    <td>: {{ $peminjaman->alat->nama_alat }}</td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>: {{ $peminjaman->jumlah }}</td>
                </tr>
                <tr>
                    <td><strong>Jumlah Rusak</strong></td>
                    <td>: {{ $peminjaman->jumlah_rusak }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>: {{ now()->format('d-m-Y') }}</td>
                </tr>
            </table>
        </div>

        <div class="line"></div>

        <div class="total">
            Total Denda: Rp {{ number_format($peminjaman->denda,0,',','.') }}
        </div>

        <div class="line"></div>

        <p>Status: <strong>LUNAS</strong></p>

        <div class="footer">
            Dokumen ini dibuat otomatis oleh sistem.
        </div>

    </div>

</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body style="font-family: Arial, sans-serif; background:#f4f6f9; padding:20px;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <table width="600" style="background:#ffffff; border-radius:8px; overflow:hidden;">

                    {{-- HEADER --}}
                    <tr>
                        <td style="background:#0d6efd; color:#ffffff; padding:20px; text-align:center;">
                            <h2 style="margin:0;">Sistem Peminjaman Alat</h2>
                            <p style="margin:0;">Nota Pembayaran Denda</p>
                        </td>
                    </tr>

                    {{-- CONTENT --}}
                    <tr>
                        <td style="padding:20px;">

                            <p>Halo <strong>{{ $peminjaman->user->name }}</strong>,</p>

                            <p>Pembayaran denda Anda telah berhasil dikonfirmasi.</p>

                            <table width="100%" style="margin-top:15px; border-collapse: collapse;">
                                <tr>
                                    <td><strong>Nama Alat</strong></td>
                                    <td>: {{ $peminjaman->alat->nama_alat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jumlah</strong></td>
                                    <td>: {{ $peminjaman->jumlah }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jumlah Rusak</strong></td>
                                    <td>: {{ $peminjaman->jumlah_rusak }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Denda</strong></td>
                                    <td>: Rp {{ number_format($peminjaman->denda,0,',','.') }}</td>
                                </tr>
                            </table>

                            <p style="margin-top:20px;">
                                Silakan lihat lampiran untuk nota resmi.
                            </p>

                            <p>Terima kasih 🙏</p>

                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td style="background:#f1f1f1; text-align:center; padding:10px; font-size:12px;">
                            © {{ date('Y') }} Sistem Peminjaman Alat
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
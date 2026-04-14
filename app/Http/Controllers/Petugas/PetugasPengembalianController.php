<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\NotaDendaMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;


class PetugasPengembalianController extends Controller
{
    public function index()
    {
        $pending = Peminjaman::with(['user', 'alat'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        $aktif = Peminjaman::with(['user', 'alat'])
            ->where('status', 'disetujui')
            ->latest()
            ->get();

        $dikembalikan = Peminjaman::with(['user', 'alat'])
            ->where('status', 'dikembalikan')
            ->latest()
            ->get();

        $konfirmasi = Peminjaman::with(['user', 'alat'])
            ->where('status', 'menunggu_konfirmasi')
            ->get();

        $menungguVerifikasi = Peminjaman::with(['user', 'alat'])
            ->where('status_pembayaran', 'menunggu_verifikasi')
            ->get();

        return view('petugas.pengembalian.index', compact('pending', 'aktif', 'dikembalikan', 'konfirmasi', 'menungguVerifikasi'));
    }
    public function konfirmasi($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        $today = Carbon::now();
        $batas = Carbon::parse($peminjaman->tanggal_harus_kembali);

        $denda = 0;

        if ($today->gt($batas)) {
            $telatHari = $batas->diffInDays($today);
            $denda = $telatHari * 10000;
        }

        $status = $denda > 0 ? 'menunggu_pembayaran' : 'dikembalikan';

        $peminjaman->update([
            'status' => $status,
            'tanggal_kembali' => now(),
            'denda' => $denda,
            'status_pembayaran' => $denda > 0 ? 'menunggu_verifikasi' : 'sudah_bayar'
        ]);

        $peminjaman->alat->increment('stok', $peminjaman->jumlah);

        logActivity(
            'Konfirmasi Pengembalian',
            'Menyetujui pengembalian alat ' . $peminjaman->alat->nama_alat
        );


        return back()->with('success', 'Pengembalian diproses');
    }

    public function rusak(Request $request, $id)
    {
        $request->validate([
            'jumlah_rusak' => 'required|integer|min:1',
            'denda' => 'required|integer|min:0'
        ]);

        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        // validasi tidak boleh lebih dari jumlah pinjam
        if ($request->jumlah_rusak > $peminjaman->jumlah) {
            return back()->with('error', 'Jumlah rusak melebihi jumlah pinjam');
        }

        $jumlahBaik = $peminjaman->jumlah - $request->jumlah_rusak;

        $peminjaman->update([
            'status' => 'menunggu_pembayaran',
            'status_pembayaran' => 'menunggu_verifikasi',
            'tanggal_kembali' => now(),
            'denda' => $request->denda,
            'jumlah_rusak' => $request->jumlah_rusak
        ]);

        // stok hanya dikembalikan yang tidak rusak
        $peminjaman->alat->increment('stok', $jumlahBaik);

        logActivity(
            'Pengembalian Rusak',
            'Alat ' . $peminjaman->alat->nama_alat .
                ' rusak sebanyak ' . $request->jumlah_rusak .
                ', denda Rp ' . $request->denda
        );

        return back()->with('success', 'Pengembalian dengan barang rusak berhasil diproses');
    }

    public function verifikasiPembayaran($id)
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])->findOrFail($id);

        $peminjaman->update([
            'status' => 'dikembalikan',
            'status_pembayaran' => 'sudah_bayar'
        ]);

        $invoice = 'INV-' . date('Ymd') . '-' . $peminjaman->id;

        $pdf = Pdf::loadView('pdf.nota', [
            'peminjaman' => $peminjaman,
            'invoice' => $invoice
        ]);

        // kirim email + PDF
        Mail::to($peminjaman->user->email)
            ->send(new NotaDendaMail($peminjaman, $pdf));

        return back()->with('success', 'Pembayaran dikonfirmasi & nota dikirim ke email');
    }
}

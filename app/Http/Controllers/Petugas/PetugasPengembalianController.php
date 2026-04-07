<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

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

        return view('petugas.pengembalian.index', compact('pending', 'aktif', 'dikembalikan'));
    }
    public function konfirmasi($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
            'denda' => 0
        ]);

        // balikin stok
        $peminjaman->alat->increment('stok', $peminjaman->jumlah);

        logActivity(
            'Konfirmasi Pengembalian',
            'Menyetujui pengembalian alat ' . $peminjaman->alat->nama_alat
        );

        return back()->with('success', 'Pengembalian disetujui');
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
            'status' => 'dikembalikan', // tetap dianggap selesai
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
}

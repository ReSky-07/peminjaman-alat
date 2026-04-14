<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\ActivityLog;
use Illuminate\Http\Request;


class PetugasPeminjamanController extends Controller
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

        return view('petugas.peminjaman.index', compact('pending', 'aktif', 'dikembalikan'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'tanggal_harus_kembali' => 'required|date|after_or_equal:today',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'disetujui',
            'tanggal_harus_kembali' => $request->tanggal_harus_kembali,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        logActivity(
            'Approve Peminjaman',
            'Menyetujui peminjaman alat ' . $peminjaman->alat->nama_alat
        );
        // kurangi stok alat
        $peminjaman->alat->decrement('stok', $peminjaman->jumlah);


        return back()->with('success', 'Peminjaman disetujui');
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Peminjaman tidak valid');
        }

        $peminjaman->update([
            'status' => 'ditolak',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        logActivity(
            'Reject Peminjaman',
            'Menolak peminjaman alat ' . $peminjaman->alat->nama_alat
        );


        return back()->with('success', 'Peminjaman ditolak');
    }

}

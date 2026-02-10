<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use Carbon\Carbon;

class PeminjamPeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $alats = Alat::where('stok', '>', 0)->get();
        return view('peminjam.peminjaman.create', compact('alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ]);

        Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('peminjam.peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim');
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak dapat mengembalikan peminjaman ini.');
        }

        if ($peminjaman->status !== 'disetujui') {
            return back()->with('error', 'Peminjaman belum disetujui atau sudah dikembalikan.');
        }
        $tanggalKembali = now();

        $denda = 0;

        // pastikan kolom tidak null
        if ($peminjaman->tanggal_harus_kembali) {
            $jatuhTempo = Carbon::parse($peminjaman->tanggal_harus_kembali)->startOfDay();
            $tanggalKembali = Carbon::now()->startOfDay();

            // hitung hanya jika lewat dari jatuh tempo
            if ($tanggalKembali->gt($jatuhTempo)) {
                $hariTerlambat = $tanggalKembali->diffInDays($jatuhTempo);
                $tarif = 5000;
                $denda = $hariTerlambat * $tarif;
            }
        }

        // update status & tanggal kembali & denda
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => $tanggalKembali,
            'denda' => $denda,
        ]);

        logActivity(
            'Pengembalian',
            'Mengembalikan alat ' . $peminjaman->alat->nama_alat .
                ' dengan denda Rp ' . $denda
        );


        // tambah stok alat
        $peminjaman->alat->increment('stok', $peminjaman->jumlah);

        return back()->with('success', 'Alat berhasil dikembalikan' . ($denda > 0 ? " dengan denda Rp " . number_format($denda, 0, ',', '.') : ''));
    }
}

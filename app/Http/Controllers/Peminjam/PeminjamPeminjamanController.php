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

        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
        ]);
        
        logActivity(
            'Pengajuan Peminjaman',
            "Mengajukan peminjaman alat {$peminjaman->alat->nama_alat} sebanyak {$request->jumlah}"
        );

        return redirect()
            ->route('peminjam.peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim');
    }
}

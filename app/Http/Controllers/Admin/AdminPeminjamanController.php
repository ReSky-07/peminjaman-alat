<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use Illuminate\Http\Request;

class AdminPeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $alats = Alat::all();

        return view('admin.peminjaman.create', compact('users', 'alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'jumlah' => 'required|integer|min:1',
        ]);

        Peminjaman::create([
            'user_id' => $request->user_id,
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    public function edit(Peminjaman $peminjaman)
    {
        $users = User::where('role', 'peminjam')->get();
        $alats = Alat::all();

        return view('admin.peminjaman.edit', compact('peminjaman', 'users', 'alats'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'user_id' => 'required',
            'alat_id' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'nullable|date',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required',
        ]);

        $peminjaman->update([
            'user_id' => $request->user_id,
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diperbarui');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return back()->with('success', 'Data peminjaman berhasil dihapus');
    }
}

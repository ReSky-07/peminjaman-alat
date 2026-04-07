<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;

class PeminjamDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $pending = Peminjaman::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        $disetujui = Peminjaman::where('user_id', $userId)
            ->where('status', 'disetujui')
            ->count();

        $dikembalikan = Peminjaman::where('user_id', $userId)
            ->where('status', 'dikembalikan')
            ->count();

        $total = Peminjaman::where('user_id', $userId)->count();

        return view('peminjam.dashboard', compact(
            'pending',
            'disetujui',
            'dikembalikan',
            'total'
        ));
    }
}

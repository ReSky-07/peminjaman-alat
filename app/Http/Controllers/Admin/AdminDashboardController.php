<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'jumlahUser' => User::count(),
            'jumlahAlat' => Alat::count(),
            'jumlahKategori' => Kategori::count(),
            'jumlahPeminjaman' => Peminjaman::count(),
        ]);
    }
}

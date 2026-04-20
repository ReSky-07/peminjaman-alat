<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        return view('petugas.dashboard',[
            'jumlahUser' => User::count(),
            'jumlahAlat' => Alat::count(),
            'jumlahKategori' => Kategori::count(),
            'jumlahPeminjaman' => Peminjaman::count(),
        ]);
    }
}

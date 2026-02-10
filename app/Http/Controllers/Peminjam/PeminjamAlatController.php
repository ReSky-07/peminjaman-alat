<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;

class PeminjamAlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->latest()->get();
        return view('peminjam.alat.index', compact('alats'));
    }
}

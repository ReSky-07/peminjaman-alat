<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamDashboardController extends Controller
{
    public function index()
    {
        return view('peminjam.dashboard');
    }
}

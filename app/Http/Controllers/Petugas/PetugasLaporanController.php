<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class PetugasLaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'alat'])
            ->whereIn('status', ['dikembalikan', 'rusak']);

        // filter jika ada input tanggal
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $tanggal_awal = Carbon::parse($request->tanggal_awal)->startOfDay();
            $tanggal_akhir = Carbon::parse($request->tanggal_akhir)->endOfDay();

            $query->whereBetween('tanggal_kembali', [$tanggal_awal, $tanggal_akhir]);
        }

        $peminjamans = $query->orderBy('tanggal_kembali', 'desc')->get();

        return view('petugas.laporan.index', compact('peminjamans'));
    }

    public function cetak(Request $request)
    {
        $query = Peminjaman::with(['user', 'alat'])
            ->whereIn('status', ['dikembalikan', 'rusak']);

        // filter jika ada input tanggal
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $tanggal_awal = Carbon::parse($request->tanggal_awal)->startOfDay();
            $tanggal_akhir = Carbon::parse($request->tanggal_akhir)->endOfDay();

            $query->whereBetween('tanggal_kembali', [$tanggal_awal, $tanggal_akhir]);
        }

        $peminjamans = $query->orderBy('tanggal_kembali', 'desc')->get();

        $pdf = PDF::loadView('petugas.laporan.cetak', [
            'peminjamans' => $peminjamans,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ])->setPaper('a4', 'landscape');

        $tanggal = Carbon::now()->format('d-m-Y');
        return $pdf->stream('laporan-pengembalian-' . $tanggal . '.pdf');
    }
}

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminAlatController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminPeminjamanController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\Petugas\PetugasPeminjamanController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Peminjam\PeminjamDashboardController;
use App\Http\Controllers\Peminjam\PeminjamPeminjamanController;
use App\Http\Controllers\Peminjam\PeminjamAlatController;
use App\Http\Controllers\Petugas\PetugasLaporanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return match (Auth::user()->role) {
        'admin' => redirect('/admin/dashboard'),
        'petugas' => redirect('/petugas/dashboard'),
        default => redirect('/peminjam/dashboard'),
    };
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.index');
    // Kelola User
    Route::get('/user', [AdminUserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/create', [AdminUserController::class, 'create'])->name('admin.user.create');
    Route::post('/user', [AdminUserController::class, 'store'])->name('admin.user.store');
    Route::get('/user/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/user/{user}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::delete('/user/{user}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
    // Kelola Alat
    Route::get('/alat', [AdminAlatController::class, 'index'])->name('admin.alat.index');
    Route::get('/alat/create', [AdminAlatController::class, 'create'])->name('admin.alat.create');
    Route::post('/alat', [AdminAlatController::class, 'store'])->name('admin.alat.store');
    Route::get('/alat/{alat}/edit', [AdminAlatController::class, 'edit'])->name('admin.alat.edit');
    Route::put('/alat/{alat}', [AdminAlatController::class, 'update'])->name('admin.alat.update');
    Route::delete('/alat/{alat}', [AdminAlatController::class, 'destroy'])->name('admin.alat.destroy');
    // Kelola Kategori
    Route::get('/kategori', [AdminKategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/kategori/create', [AdminKategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('/kategori', [AdminKategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/kategori/{kategori}/edit', [AdminKategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/kategori/{kategori}', [AdminKategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/kategori/{kategori}', [AdminKategoriController::class, 'destroy'])->name('admin.kategori.destroy');
    // Kelola Peminjaman
    Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])->name('admin.peminjaman.index');
    Route::get('/peminjaman/create', [AdminPeminjamanController::class, 'create'])->name('admin.peminjaman.create');
    Route::post('/peminjaman', [AdminPeminjamanController::class, 'store'])->name('admin.peminjaman.store');
    Route::get('/peminjaman/{peminjaman}/edit', [AdminPeminjamanController::class, 'edit'])->name('admin.peminjaman.edit');
    Route::put('/peminjaman/{peminjaman}', [AdminPeminjamanController::class, 'update'])->name('admin.peminjaman.update');
    Route::delete('/peminjaman/{peminjaman}', [AdminPeminjamanController::class, 'destroy'])->name('admin.peminjaman.destroy');
    // Activity Log
    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('admin.activity.index');
});


// Route Petugas
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->group(function () {
    // dashboard
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.index');
    // Peminjaman
    Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])->name('petugas.peminjaman.index');
    Route::post('/peminjaman/{peminjaman}/approve', [PetugasPeminjamanController::class, 'approve'])->name('petugas.peminjaman.approve');
    Route::post('/peminjaman/{peminjaman}/reject', [PetugasPeminjamanController::class, 'reject'])->name('petugas.peminjaman.reject');
    // Laporan
    Route::get('/petugas/laporan', [PetugasLaporanController::class, 'index'])->name('petugas.laporan.index');
    Route::get('/petugas/laporan/cetak', [PetugasLaporanController::class, 'cetak'])->name('petugas.laporan.cetak');
});


// Route Peminjam
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->group(function () {
    // dashboard
    Route::get('/dashboard', [PeminjamDashboardController::class, 'index'])->name('peminjam.index');
    // Peminjaman
    Route::get('/peminjaman', [PeminjamPeminjamanController::class, 'index'])->name('peminjam.peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamPeminjamanController::class, 'create'])->name('peminjam.peminjaman.create');
    Route::post('/peminjaman', [PeminjamPeminjamanController::class, 'store'])->name('peminjam.peminjaman.store');
    // Pengembalian
    Route::post('/peminjam/pengembalian/{id}', [PeminjamPeminjamanController::class, 'kembalikan'])->name('peminjam.peminjaman.kembalikan');
    // Lihat Alat
    Route::get('/peminjam/alat', [PeminjamAlatController::class, 'index'])->name('peminjam.alat.index');
});

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/alat', function () {
        return 'Kelola alat';
    });
});


require __DIR__ . '/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ViolationCategoryController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\DashboardSiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\JenisApresiasiController;

Route::get('/apresiasi', [JenisApresiasiController::class, 'index'])->name('apresiasi.index');
// Pastikan mengarah ke SiswaController
Route::get('/prestasi/create', [SiswaController::class, 'createPrestasi'])->name('prestasi.create');
// Tambahkan route GET untuk menampilkan halaman form di web.php
// Jalur pengiriman data dari form Input Prestasi Kompetisi
Route::post('/prestasi/store', [PrestasiController::class, 'store'])->name('prestasi.store');

// Route untuk menampilkan halaman utama manajemen user
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Grup Route POST penampung submit form modal data pengguna
Route::prefix('users')->name('users.')->group(function () {
    Route::post('/siswa', [UserController::class, 'storeSiswa'])->name('siswa.store');
    Route::post('/walas', [UserController::class, 'storeWalas'])->name('walas.store');
    Route::post('/bk', [UserController::class, 'storeBk'])->name('bk.store');
    Route::post('/osis', [UserController::class, 'storeOsis'])->name('osis.store');
    Route::post('/ortu', [UserController::class, 'storeOrtu'])->name('ortu.store');
    Route::post('/admin', [UserController::class, 'storeAdmin'])->name('admin.store');
});
/*
|--------------------------------------------------------------------------
| Web Routes - SISPOINT SMKN 1 KOTA BEKASI
|--------------------------------------------------------------------------
*/

// ==========================================
// Halaman Publik & Autentikasi
// ==========================================
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/landing', function () { return view('landing'); });

// Halaman Form Login (GET)
Route::get('/login', function () { return view('login'); })->name('login');

// Proses Validasi Form Login (POST)
Route::post('/login', [SiswaController::class, 'loginProcess'])->name('login.process');

// Proses Keluar Aplikasi/Logout (POST)
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


// ==========================================
// MANAJEMEN DIREKTORI KELAS (CRUD)
// ==========================================
Route::get('/direktori-kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::post('/direktori-kelas', [KelasController::class, 'store'])->name('kelas.store');
Route::get('/direktori-kelas/{id}', [KelasController::class, 'show'])->name('kelas.show'); 
Route::put('/direktori-kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
Route::patch('/direktori-kelas/{id}/status', [KelasController::class, 'updateStatus'])->name('kelas.updateStatus');
Route::delete('/direktori-kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');


// ==========================================
// PUSAT KONTROL MANAJEMEN PENGGUNA (ADMIN MULTI-ROLE CRUD)
// ==========================================
// Tampilan Utama Manajemen Pengguna
Route::get('/users', [SiswaController::class, 'index'])->name('users.index');

// Memproses penambahan data per masing-masing role (Sinkron dengan SiswaController)
Route::post('/users/siswa', [SiswaController::class, 'storeSiswa'])->name('users.siswa.store');
Route::post('/users/walas', [SiswaController::class, 'storeWalas'])->name('users.walas.store');
Route::post('/users/bk/store', [SiswaController::class, 'storeBk'])->name('users.bk.store');
Route::post('/users/osis/store', [SiswaController::class, 'storeOsis'])->name('users.osis.store');
Route::post('/users/ortu/store', [SiswaController::class, 'storeOrtu'])->name('users.ortu.store');
Route::post('/users/admin/store', [SiswaController::class, 'storeAdmin'])->name('users.admin.store');

// Menghapus data siswa beserta user loginnya (Mengarah ke destroySiswa)
Route::delete('/users/siswa/{nis}', [SiswaController::class, 'destroySiswa'])->name('users.siswa.destroy');


// ==========================================
// FITUR SISPOINT LAINNYA
// ==========================================
// Kategori Pelanggaran (Resource CRUD)
Route::resource('violation-categories', ViolationCategoryController::class);

// Kategori Apresiasi / Prestasi
Route::get('/apresiasi', function () {
    $appreciations = []; 
    return view('apresiasi', compact('appreciations'));
})->name('appreciation-categories.index'); 
Route::post('/apresiasi', function () { return redirect()->back(); })->name('appreciation-categories.store');

// Fitur Dashboard Siswa & Halaman Skor
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
Route::get('/dashboardSiswa', [DashboardSiswaController::class, 'index'])->name('dashboard.siswa');
Route::get('/students', function () { return view('students'); });
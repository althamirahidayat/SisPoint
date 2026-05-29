<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ViolationCategoryController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\DashboardSiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;

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
    \Illuminate\Support\Facades\Auth::logout(); // <-- Perbaikan Typo Support0 menjadi Support
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
// PUSAT KONTROL MANAJEMEN PENGGUNA (ADMIN CRUD)
// ==========================================
Route::get('/users', [SiswaController::class, 'index'])->name('users.index');

// Memproses penambahan data siswa baru
Route::post('/users/siswa', [SiswaController::class, 'store'])->name('users.siswa.store');

// Memproses penambahan data wali kelas baru
Route::post('/users/walas', [SiswaController::class, 'storeWalas'])->name('users.walas.store');

// Menghapus data siswa beserta user loginnya
Route::delete('/users/siswa/{nis}', [SiswaController::class, 'destroy'])->name('users.siswa.destroy');


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
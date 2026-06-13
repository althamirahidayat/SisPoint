<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, ViolationCategoryController, LeaderboardController, DashboardSiswaController, SiswaController, KelasController, PrestasiController, JenisApresiasiController};
use App\Http\Controllers\AuthController;
use App\Models\ViolationCategory;

// ==========================================
// AUTHENTICATION
// ==========================================

Route::get('/login', [SiswaController::class, 'loginView'])
    ->name('login');

Route::post('/login', [SiswaController::class, 'loginProcess'])
    ->name('login.process');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');
// ==========================================
// DASHBOARD & PUBLIK
// ==========================================
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboardSiswa', [DashboardSiswaController::class, 'index'])
    ->middleware('auth:web') 
    ->name('dashboard.siswa');
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

// ==========================================
// ADMIN: MANAJEMEN PENGGUNA (PABRIK AKUN)
// ==========================================
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('index');
    Route::post('/siswa', [SiswaController::class, 'storeSiswa'])->name('siswa.store');
    Route::post('/walas', [SiswaController::class, 'storeWalas'])->name('walas.store');
    Route::post('/bk', [SiswaController::class, 'storeBk'])->name('bk.store');
    Route::post('/osis', [SiswaController::class, 'storeOsis'])->name('osis.store');
    Route::post('/ortu', [SiswaController::class, 'storeOrtu'])->name('ortu.store');
    Route::post('/admin', [SiswaController::class, 'storeAdmin'])->name('admin.store');
    Route::delete('/siswa/{nis}', [SiswaController::class, 'destroySiswa'])->name('siswa.destroy');
});

// ==========================================
// FITUR SISPOINT
// ==========================================
Route::resource('violation-categories', ViolationCategoryController::class);
Route::get('/apresiasi', [JenisApresiasiController::class, 'index'])->name('apresiasi.index');
Route::get('/direktori-kelas', [KelasController::class, 'index'])->name('kelas.index');
Route::post('/apresiasi', [JenisApresiasiController::class, 'store'])->name('appreciation-categories.store');
Route::get('/kelas/{id}', [App\Http\Controllers\KelasController::class, 'show'])->name('kelas.show');
Route::patch('/kelas/{id}/update-status', [App\Http\Controllers\KelasController::class, 'updateStatus'])->name('kelas.updateStatus');
Route::delete('/kelas/{id}', [App\Http\Controllers\KelasController::class, 'destroy'])->name('kelas.destroy');
Route::post('/kelas', [App\Http\Controllers\KelasController::class, 'store'])->name('kelas.store');
Route::get('/prestasi/create', [PrestasiController::class, 'create'])->name('prestasi.create');
Route::post('/prestasi/store', [PrestasiController::class, 'store'])->name('prestasi.store');
Route::middleware('auth')->group(function () {

    Route::get('/dashboardSiswa', [DashboardSiswaController::class, 'index'])
        ->name('dashboard.siswa');

    Route::get('/siswa/jenis-pelanggaran', [DashboardSiswaController::class, 'jenisPelanggaran'])
        ->name('siswa.jenis-pelanggaran');

});
Route::get(
    '/siswa/jenis-pelanggaran',
    [DashboardSiswaController::class, 'jenisPelanggaran']
)->name('siswa.jenis-pelanggaran');

Route::get('/siswa/jenis-pelanggaran', function () {

    $categories = ViolationCategory::all();

    return view('dashboard.jenis-pelanggaran-siswa', compact('categories'));
});

Route::get('/siswa/jenis-pelanggaran', [DashboardSiswaController::class, 'jenisPelanggaran'])
    ->name('siswa.jenis-pelanggaran');
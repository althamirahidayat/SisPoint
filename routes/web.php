<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ViolationCategoryController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/users', function () {
    return view('users');
});

Route::get('/students', function () {
    return view('students');
});

Route::get('/apresiasi', function () {
    $appreciations = []; 
    return view('apresiasi', compact('appreciations'));
})->name('appreciation-categories.index'); 


Route::post('/apresiasi', function () {
    return redirect()->back();
})->name('appreciation-categories.store');

use App\Http\Controllers\LeaderboardController;

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

Route::resource('violation-categories', ViolationCategoryController::class);

use App\Http\Controllers\DashboardSiswaController;

// Proteksi rute menggunakan middleware auth bawaan Laravel
Route::middleware(['auth'])->group(function () {
    
    // Jalur utama menuju Dashboard Siswa
    Route::get('/dashboardSiswa', [DashboardSiswaController::class, 'index'])->name('dashboard.siswa');
    
});
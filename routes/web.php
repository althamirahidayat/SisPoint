<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViolationCategoryController;

Route::get('/', function () {
    return view('dashboard'); 
});

// 
Route::get('/users', function () {
    return view('users');
});

Route::get('/students', function () {
    return view('students');
});

// 1. Route untuk menampilkan halaman apresiasi
Route::get('/apresiasi', function () {
    $appreciations = []; 
    return view('apresiasi', compact('appreciations'));
})->name('appreciation-categories.index'); // Tambahkan nama ini untuk keamanan sidebar

// 2. TAMBAHKAN BARIS INI (Bypass Route untuk Form Modal Piwa)
Route::post('/apresiasi', function () {
    // Sementara kita kosongkan dulu proses simpannya agar tidak error saat diklik
    return redirect()->back();
})->name('appreciation-categories.store');

use App\Http\Controllers\LeaderboardController;

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

Route::resource('violation-categories', ViolationCategoryController::class);
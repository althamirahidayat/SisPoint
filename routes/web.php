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


use App\Http\Controllers\LeaderboardController;

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

Route::resource('violation-categories', ViolationCategoryController::class);
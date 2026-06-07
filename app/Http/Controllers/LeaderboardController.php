<?php

namespace App\Http\Controllers;

use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        // 1. Ambil user dengan role siswa
        // 2. Load relasi 'siswa' agar bisa akses kelas
        // 3. Urutkan berdasarkan total_prestasi dari yang terbesar
        $topSiswa = User::where('role', 'siswa')
                        ->with('siswa') 
                        ->orderBy('total_prestasi', 'desc') 
                        ->get();

        return view('leaderboard', compact('topSiswa'));
    }
}
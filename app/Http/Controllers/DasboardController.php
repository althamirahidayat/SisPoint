<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ViolationCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Sementara hitung total seluruh user yang ada di tabel biar tidak error kolom 'role'
        $totalSiswa = User::count(); 
        $totalGuru = 0; // Di-set 0 dulu sementara

        // Di-set 0 untuk keamanan data log aktivitas yang belum ada tabelnya
        $pelanggaranHariIni = 0;
        $prestasiBulanIni = 0;

        // Mengambil 3 data user teratas untuk mengisi list ranking sementara
        $topSiswa = User::take(3)->get();

        // Kirim semua variabel ke view dashboard
        return view('dashboard', compact(
            'totalSiswa', 
            'totalGuru', 
            'pelanggaranHariIni', 
            'prestasiBulanIni', 
            'topSiswa'
        ));
    }
}
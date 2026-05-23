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
    // Karena kolom 'role' belum ada, sementara kita hitung total semua user di tabel dulu biar gak error
    $totalSiswa = User::count(); 
    $totalGuru = 0; // Kita set 0 dulu sementara

    // Set nilai 0 untuk keamanan data log
    $pelanggaranHariIni = 0;
    $prestasiBulanIni = 0;

    // Kita ambil 3 data user teratas apa saja untuk ranking sementara
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
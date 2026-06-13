<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan semua variabel sudah didefinisikan
        $totalSiswa = \App\Models\Siswa::count();
        $totalGuru = \App\Models\User::whereIn('role', ['admin', 'guru_bk', 'walas'])->count();
        
        // Gunakan 0 sebagai nilai default jika data tidak ditemukan agar tidak error
        $pelanggaranHariIni = \App\Models\Pelanggaran::whereDate('created_at', Carbon::today())->count() ?? 0;
        $prestasiBulanIni = \App\Models\Prestasi::whereMonth('created_at', Carbon::now()->month)->count() ?? 0;
        
        $topSiswa = \App\Models\Siswa::with('user')
                        ->orderBy('total_poin_prestasi', 'desc')
                        ->limit(5)
                        ->get();
    
        
        return view('dashboard.admin', compact(
            'totalSiswa', 
            'totalGuru', 
            'pelanggaranHariIni', 
            'prestasiBulanIni', 
            'topSiswa'
        ));
    }

    public function dashboardSiswa()
{
    // Mengambil user yang sedang login
    $user = Auth::user();
    // Mengambil data siswa melalui relasi 'siswa' di model User
    // (Pastikan relasi di User.php sudah benar)
    $siswa = $user->siswa; 

    // Jika data siswa tidak ditemukan (mungkin belum di-input)
    if (!$siswa) {
        return redirect()->back()->with('error', 'Profil siswa belum lengkap.');
    }

    // Kirim data ke view
    return view('dashboard.siswa', compact('siswa'));
}
}
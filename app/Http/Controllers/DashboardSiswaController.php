<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ViolationCategory;

class DashboardSiswaController extends Controller
{
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Ambil data siswa yang terhubung dengan akun login
        $siswa = $user->siswa;

        // Jika akun login bukan siswa atau relasi belum ada
        if (!$siswa) {
            return redirect()->back()->with(
                'error',
                'Data siswa tidak ditemukan untuk akun ini.'
            );
        }

        // Statistik siswa
        $poinPelanggaran = $siswa->total_poin_pelanggaran ?? 0;
        $totalPrestasi = $siswa->total_poin_prestasi ?? 0;

        // Sementara masih kosong sampai tabel riwayat dibuat
        $riwayatAktivitas = collect([]);

        // Top siswa berdasarkan prestasi
        $topSiswa = DB::table('siswa')
            ->select(
                'nama_lengkap',
                'kelas',
                'total_poin_prestasi'
            )
            ->orderByDesc('total_poin_prestasi')
            ->limit(5)
            ->get();

        return view('dashboard.siswa', [
            'user' => $user,
            'siswa' => $siswa,
            'poinPelanggaran' => $poinPelanggaran,
            'totalPrestasi' => $totalPrestasi,
            'riwayatAktivitas' => $riwayatAktivitas,
            'topSiswa' => $topSiswa,
        ]);
    }

    public function jenisPelanggaran()
{
    $categories = ViolationCategory::all();

    return view(
        'dashboard.jenis-pelanggaran-siswa',
        compact('categories')
    );
}
}
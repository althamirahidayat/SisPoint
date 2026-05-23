<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardSiswaController extends Controller
{
    // Hapus atau jangan pakai middleware auth di __construct dulu jika ada

    public function index()
    {
        // 1. BYPASS LOGIN: Buat data siswa tiruan agar tidak memicu error auth
        $user = (object)[
            'name' => 'Althamira Hidayat', // Pakai namamu dulu buat test tampilan
            'kelas' => 'XI PPLG',
            'poin_pelanggaran' => 5,
            'total_prestasi' => 2
        ];

        // 2. Mengambil akumulasi poin pelanggaran dari objek di atas
        $poinPelanggaran = $user->poin_pelanggaran ?? 0; 

        // 3. Menghitung total prestasi
        $totalPrestasi = $user->total_prestasi ?? 0;

        // 4. Mengambil data Riwayat Aktivitas 7 hari terakhir (Dummy Terstruktur)
        $riwayatAktivitas = [
            [
                'status' => 'danger',
                'icon' => 'fa-circle-info',
                'judul' => 'Pelanggaran Dicatat',
                'keterangan' => 'Terlambat masuk sekolah',
                'poin' => '-5 Poin',
                'tanggal' => Carbon::parse('2026-02-20')->isoFormat('D MMMM YYYY')
            ],
            [
                'status' => 'success',
                'icon' => 'fa-circle-check',
                'judul' => 'Prestasi Diraih',
                'keterangan' => 'Juara 1 lomba coding tingkat kota',
                'poin' => '+50 Poin',
                'tanggal' => Carbon::parse('2026-02-15')->isoFormat('D MMMM YYYY')
            ]
        ];

        // 5. Mengambil data Top Siswa (Leaderboard) - Dibungkus try-catch agar jika kolom 'role' belum ada tidak crash
        try {
            $topSiswa = DB::table('users')
                ->orderBy('id', 'desc')
                ->limit(5)
                ->get();
        } catch (\Exception $e) {
            $topSiswa = collect([]);
        }

        // Jika database kosong, pakai backup array biar tidak kosong tampilannya
        if ($topSiswa->isEmpty()) {
            $topSiswa = collect([
                (object)['name' => 'Citra Lestari', 'kelas' => 'XI PPLG B', 'total_prestasi' => 12],
                (object)['name' => 'Budi Santoso', 'kelas' => 'XI RPL A', 'total_prestasi' => 8],
                (object)['name' => 'Eko Prasetyo', 'kelas' => 'X TKR A', 'total_prestasi' => 5],
                (object)['name' => 'Ahmad Fauzi', 'XII RPL B', 'total_prestasi' => 3],
                (object)['name' => 'Dewi Anggraeni', 'kelas' => 'X DKV B', 'total_prestasi' => 1],
            ]);
        }

        // 6. Alirkan seluruh data ke dalam file blade view
        return view('dashboardSiswa', compact(
            'user', 
            'poinPelanggaran', 
            'totalPrestasi', 
            'riwayatAktivitas', 
            'topSiswa'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardSiswaController extends Controller
{
    public function index()
    {
        // 1. Ambil data siswa yang saat ini sedang login secara realtime
        $user = Auth::user();

        // 2. Mengambil akumulasi poin pelanggaran langsung dari database siswa tersebut
        // (Asumsi: Anda memiliki kolom 'poin_pelanggaran' atau relasi tabel pelanggaran)
        $poinPelanggaran = $user->poin_pelanggaran ?? 0; 

        // 3. Menghitung total prestasi yang pernah diraih siswa
        // (Asumsi: Anda memiliki tabel/kolom 'total_prestasi' atau menghitung baris datanya)
        $totalPrestasi = $user->total_prestasi ?? 0;

        // 4. Mengambil data Riwayat Aktivitas 7 hari terakhir secara dinamis
        // Kita gunakan data dummy terstruktur dahulu jika tabel riwayat Anda belum siap,
        // namun siap diganti dengan query database seperti: DB::table('aktifitas')->where('user_id', $user->id)->get();
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

        // 5. Mengambil data Top Siswa (Leaderboard) dari sekolah secara dinamis
        // Mengurutkan siswa berdasarkan perolehan prestasi terbanyak
        // Jika tabel belum lengkap, ini akan mengambil data user ber-role siswa secara acak/dummy terstruktur
        $topSiswa = DB::table('users')
            ->where('role', 'siswa')
            ->orderBy('total_prestasi', 'desc')
            ->limit(5)
            ->get();

        // Jika database users Anda masih kosong/belum ada kolom total_prestasi, kita buat backup array biar tidak crash
        if ($topSiswa->isEmpty()) {
            $topSiswa = collect([
                (object)['name' => 'Citra Lestari', 'kelas' => 'XI PPLG B', 'total_prestasi' => 12],
                (object)['name' => 'Budi Santoso', 'kelas' => 'XI RPL A', 'total_prestasi' => 8],
                (object)['name' => 'Eko Prasetyo', 'kelas' => 'X TKR A', 'total_prestasi' => 5],
                (object)['name' => 'Ahmad Fauzi', 'kelas' => 'XII RPL B', 'total_prestasi' => 3],
                (object)['name' => 'Dewi Anggraeni', 'kelas' => 'X DKV B', 'total_prestasi' => 1],
            ]);
        }

        // 6. Alirkan seluruh data di atas ke dalam file blade view Anda
        return view('dashboardSiswa', compact(
            'user', 
            'poinPelanggaran', 
            'totalPrestasi', 
            'riwayatAktivitas', 
            'topSiswa'
        ));
    }
}
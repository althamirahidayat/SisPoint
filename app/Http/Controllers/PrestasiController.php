<?php

namespace App\Http\Controllers;

use App\Models\Perlombaan;
use App\Models\PrestasiSiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestasiController extends Controller
{

    public function create()
{
    $appreciations = \App\Models\PrestasiSiswa::all();
    return view('apresiasi', compact('appreciations'));
}
    public function store(Request $request)
    {
        // 1. Validasi Input Form (Sesuaikan dengan atribut name di HTML form kamu)
        $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'kategori' => 'required',
            'tanggal_pengumuman' => 'required|date',
            'lampiran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal upload foto 2MB
            'siswa_id' => 'required|array', // Harus berupa array karena muridnya dinamis
            'siswa_id.*' => 'required|exists:users,id',
            'kemenangan.*' => 'required',
            'poin_tambahan.*' => 'required|integer|min:0',
        ]);

        // 2. Mulai transaksi database agar data sinkron dan tidak korup/menggantung
        DB::transaction(function () use ($request) {
            
            // Proses upload file lampiran/foto dokumen jika ada
            $lampiranPath = null;
            if ($request->hasFile('lampiran')) {
                $lampiranPath = $request->file('lampiran')->store('lampiran_prestasi', 'public');
            }

            // Simpan data utama perlombaan ke tabel 'perlombaans'
            $lomba = Perlombaan::create([
                'nama_lomba' => $request->nama_lomba,
                'kategori' => $request->kategori,
                'tanggal_pengumuman' => $request->tanggal_pengumuman,
                'lampiran' => $lampiranPath,
            ]);

            // Looping data murid yang diinput bersamaan menggunakan array index
            foreach ($request->siswa_id as $index => $siswaId) {
                
                // Simpan baris murid ke tabel 'prestasi_siswas'
                PrestasiSiswa::create([
                    'perlombaan_id' => $lomba->id, // Diikat ke id perlombaan di atas
                    'user_id' => $siswaId,
                    'kemenangan' => $request->kemenangan[$index],
                    'poin_tambahan' => $request->poin_tambahan[$index],
                ]);

                // Opsional: Jika kamu punya kolom total_prestasi langsung di tabel users 
                // untuk kebutuhan leaderboard instant, jalankan perintah naikkan poin otomatis ini:
                $user = User::find($siswaId);
                if ($user) {
                    $user->increment('total_prestasi', $request->poin_tambahan[$index]);
                }
            }
        });

        // Kembali ke halaman leaderboard dengan notifikasi sukses
        return redirect()->route('leaderboard.index')->with('success', 'Prestasi kompetisi kelompok berhasil dicatatkan!');
    }

    
}
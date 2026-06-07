<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas; // Pastikan kamu punya model Kelas
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // 1. TAMPILKAN HALAMAN MANAGEMENT UTAMA
    public function index(Request $request)
    {
        $kelas = Kelas::all(); // Mengambil data kelas untuk dropdown filter dan modal
        
        // Query dasar mengambil semua user beserta relasinya jika ada
        $query = User::query();

        // Logika pencarian data
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('username', 'like', "%$search%")
                  ->orWhere('role', 'like', "%$search%");
            });
        }

        // Logika filter berdasarkan Role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $allUsers = $query->latest()->get();

        return view('users', compact('allUsers', 'kelas'));
    }

    // 2. SIMPAN AKUN SISWA
    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:users,username', // NIS dijadikan username, jadi harus unik
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            // Pembuatan User Akun Utama Login
            $user = User::create([
                'name' => $request->nama_lengkap,
                'username' => $request->nis, // Username login menggunakan NIS
                'password' => Hash::make($request->nis), // Password bawaan otomatis menggunakan NIS juga
                'role' => 'siswa',
            ]);

            // Di sini kamu bisa menghubungkan ke tabel detail 'siswas' jika menggunakan relasi terpisah, contoh:
            // $user->siswa()->create([
            //     'nis' => $request->nis,
            //     'kelas' => $request->kelas,
            //     'no_telp' => $request->no_telp,
            //     'alamat' => $request->alamat,
            // ]);
        });

        return redirect()->route('users.index')->with('success', 'Akun Siswa berhasil dibuat otomatis!');
    }

    // 3. SIMPAN AKUN WALI KELAS
    public function storeWalas(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:users,username',
            'nama' => 'required|string|max:255',
            'kelas_binaan' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            User::create([
                'name' => $request->nama,
                'username' => $request->nip, // Username login menggunakan NIP
                'password' => Hash::make($request->nip), // Password bawaan menggunakan NIP
                'role' => 'walas',
            ]);
            
            // Opsional: simpan ke detail tabel wali kelas jika ada
        });

        return redirect()->route('users.index')->with('success', 'Akun Wali Kelas berhasil ditambahkan!');
    }

    // 4. SIMPAN AKUN GURU BK
    public function storeBk(Request $request)
    {
        $request->validate([
            'nip_bk' => 'required|unique:users,username',
            'nama_bk' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            User::create([
                'name' => $request->nama_bk,
                'username' => $request->nip_bk,
                'password' => Hash::make($request->nip_bk),
                'role' => 'bk',
            ]);
        });

        return redirect()->route('users.index')->with('success', 'Akun Guru BK berhasil didaftarkan!');
    }

   // 5. SIMPAN AKUN OSIS (Sudah diperbaiki tanda kurungnya)
   public function storeOsis(Request $request)
   {
       $request->validate([
           'nama_osis' => 'required|string|max:255',
       ]);

       // Karena OSIS mungkin tidak punya NIP/NIS di form, kita buat username dari nama tanpa spasi + angka acak
       $cleanName = strtolower(str_replace(' ', '', $request->nama_osis));
       $usernameOsis = $cleanName . rand(10, 99);

       DB::transaction(function () use ($request, $usernameOsis) {
           User::create([
               'name' => $request->nama_osis,
               'username' => $usernameOsis,
               'password' => Hash::make('osis123'), // Password default OSIS
               'role' => 'osis',
           ]);
       }); // <-- DI SINI PERBAIKANNYA: Sebelumnya tertulis ]); berubah menjadi });

       return redirect()->route('users.index')->with('success', "Akun OSIS berhasil dibuat! Username: $usernameOsis");
   }

    // 6. SIMPAN AKUN ORANG TUA
    public function storeOrtu(Request $request)
    {
        $request->validate([
            'nik_ortu' => 'required|unique:users,username',
            'nama_ortu' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            User::create([
                'name' => $request->nama_ortu,
                'username' => $request->nik_ortu,
                'password' => Hash::make($request->nik_ortu),
                'role' => 'ortu',
            ]);
        });

        return redirect()->route('users.index')->with('success', 'Akun Orang Tua siswa berhasil dikoneksikan!');
    }

    // 7. SIMPAN AKUN ADMIN
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:255',
        ]);

        $usernameAdmin = 'admin.' . strtolower(str_replace(' ', '', $request->nama_admin));

        DB::transaction(function () use ($request, $usernameAdmin) {
            User::create([
                'name' => $request->nama_admin,
                'username' => $usernameAdmin,
                'password' => Hash::make('adminpoint'), // Password bawaan admin pusat
                'role' => 'admin',
            ]);
        });

        return redirect()->route('users.index')->with('success', "Akun Admin baru berhasil aktif! Username: $usernameAdmin");
    }
}
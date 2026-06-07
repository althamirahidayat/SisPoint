<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\GuruBk;
use App\Models\Osis;
use App\Models\OrangTua;
use App\Models\AdminProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class SiswaController extends Controller
{
    /**
     * TAMPILAN UTAMA & INTEGRASI FITUR PENCARIAN
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filterRole = $request->input('role');
        $filterKelas = $request->input('kelas');

        // Menggunakan User sebagai master data agar semua role ikut terbawa
        $userQuery = User::with(['siswa', 'guruBk', 'osis', 'orangTua', 'adminProfile']);

        // ---- LOGIKA SEARCH BAR (Pencarian Multi-Tabel) ----
        if ($search) {
            $userQuery->where(function ($q) use ($search) {
                // Cari dari tabel users utama
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('username', 'like', '%' . $search . '%')
                  ->orWhere('role', 'like', '%' . $search . '%')
                  
                  // Cari ke dalam sub-tabel siswa (Nama Lengkap / Kelas)
                  ->orWhereHas('siswa', function ($querySiswa) use ($search) {
                      $querySiswa->where('nama_lengkap', 'like', '%' . $search . '%')
                                 ->orWhere('kelas', 'like', '%' . $search . '%');
                  })
                  
                  // Cari ke sub-tabel Orang Tua (Nama Anak / Kelas Anak)
                  ->orWhereHas('orangTua', function ($queryOrtu) use ($search) {
                      $queryOrtu->where('nama_ortu', 'like', '%' . $search . '%')
                                ->orWhere('nama_anak', 'like', '%' . $search . '%');
                  });
            });
        }

        // ---- LOGIKA FILTER ROLE ----
        if ($filterRole) {
            $userQuery->where('role', $filterRole);
        }

        // ---- LOGIKA FILTER KELAS ----
        if ($filterKelas) {
            $userQuery->where(function ($q) use ($filterKelas) {
                // Filter kelas untuk akun siswa
                $q->whereHas('siswa', function ($querySiswa) use ($filterKelas) {
                    $querySiswa->where('kelas', $filterKelas);
                });
            });
        }

        // Urutkan dari akun yang paling baru dibuat
        $allUsers = $userQuery->latest()->get();
        $kelas = Kelas::all(); 

        // Return ke view tunggal 'users' membawa data hasil filter pencarian
        return view('users', compact('allUsers', 'kelas'));
    }

    /**
     * PROSES SIMPAN DATA SISWA
     */
    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nis'          => 'required|unique:siswa,nis',
            'nama_lengkap' => 'required|string|max:150',
            'kelas'        => 'required|string|max:50',
            'alamat'       => 'nullable|string',
            'no_telp'      => 'nullable|string|max:15',
        ]);

        $firstWord = Str::slug(explode(' ', $request->nama_lengkap)[0], '_');
        $usernameGenerated = $firstWord . '_siswa';

        if (User::where('username', $usernameGenerated)->exists()) {
            $usernameGenerated = $firstWord . '_' . Str::lower(Str::random(3)) . '_siswa';
        }

        DB::transaction(function () use ($request, $usernameGenerated) {
            $user = User::create([
                'name'     => $request->nama_lengkap,
                'username' => $usernameGenerated,
                'password' => Hash::make($request->nis), 
                'role'     => 'siswa',
            ]);

            Siswa::create([
                'nis'          => $request->nis,
                'user_id'      => $user->id, 
                'nama_lengkap' => $request->nama_lengkap,
                'kelas'        => $request->kelas,
                'alamat'       => $request->alamat,
                'no_telp'      => $request->no_telp,
            ]);
        });

        return redirect()->route('users.index')->with('success', 'Akun Siswa ' . $request->nama_lengkap . ' berhasil dibuat!');
    }

    /**
     * PROSES SIMPAN DATA WALI KELAS
     */
    public function storeWalas(Request $request)
    {
        $request->validate([
            'nip'          => 'required|string',
            'nama'         => 'required|string|max:150',
            'kelas_binaan' => 'required|string',
            'no_telp'      => 'nullable|string',
            'alamat'       => 'nullable|string',
        ]);

        $firstWordWalas = Str::slug(explode(' ', $request->nama)[0], '_');
        $usernameWalasGenerated = $firstWordWalas . '_wali';

        if (User::where('username', $usernameWalasGenerated)->exists()) {
            $usernameWalasGenerated = $firstWordWalas . '_' . Str::lower(Str::random(3)) . '_wali';
        }

        DB::transaction(function () use ($request, $usernameWalasGenerated) {
            $user = User::create([
                'name'     => $request->nama,
                'username' => $usernameWalasGenerated,
                'password' => Hash::make('12345678'),
                'role'     => 'walas',
            ]);

            DB::table('wali_kelas')->insert([
                'nip_walas'    => $request->nip,
                'id_user'      => $user->id,
                'nama_walas'   => $request->nama,
                'kelas_binaan' => $request->kelas_binaan,
                'no_telp_walas'=> $request->no_telp,
                'alamat_walas' => $request->alamat,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        });

        return redirect()->route('users.index')->with('success', 'Akun Wali Kelas ' . $request->nama . ' berhasil dibuat!');
    }

    /**
     * PROSES SIMPAN DATA GURU BK
     */
    public function storeBk(Request $request)
    {
        $request->validate([
            'nip_bk'   => 'required|string|unique:guru_bk,nip_bk',
            'nama_bk'  => 'required|string|max:150',
            'no_telp'  => 'nullable|string',
            'alamat'   => 'nullable|string',
        ]);

        $firstWord = Str::slug(explode(' ', $request->nama_bk)[0], '_');
        $usernameGenerated = $firstWord . '_bk';

        if (User::where('username', $usernameGenerated)->exists()) {
            $usernameGenerated = $firstWord . '_' . Str::lower(Str::random(3)) . '_bk';
        }

        DB::transaction(function () use ($request, $usernameGenerated) {
            $user = User::create([
                'name'     => $request->nama_bk,
                'username' => $usernameGenerated,
                'password' => Hash::make('12345678'),
                'role'     => 'bk',
            ]);

            GuruBk::create([
                'nip_bk'     => $request->nip_bk,
                'id_user'    => $user->id,
                'nama_bk'    => $request->nama_bk,
                'no_telp_bk' => $request->no_telp,
                'alamat_bk'  => $request->alamat,
            ]);
        });

        return redirect()->route('users.index')->with('success', 'Akun Guru BK ' . $request->nama_bk . ' berhasil dibuat!');
    }

    /**
     * PROSES SIMPAN DATA OSIS
     */
    public function storeOsis(Request $request)
    {
        $request->validate([
            'nama_osis'  => 'required|string|max:150',
            'kelas_osis' => 'required|string|max:50',
            'no_telp'    => 'nullable|string',
        ]);

        $firstWord = Str::slug(explode(' ', $request->nama_osis)[0], '_');
        $usernameGenerated = $firstWord . '_osis';

        if (User::where('username', $usernameGenerated)->exists()) {
            $usernameGenerated = $firstWord . '_' . Str::lower(Str::random(3)) . '_osis';
        }

        DB::transaction(function () use ($request, $usernameGenerated) {
            $user = User::create([
                'name'     => $request->nama_osis,
                'username' => $usernameGenerated,
                'password' => Hash::make('12345678'),
                'role'     => 'osis',
            ]);

            Osis::create([
                'id_user'      => $user->id,
                'nama_osis'    => $request->nama_osis,
                'kelas_osis'   => $request->kelas_osis,
                'no_telp_osis' => $request->no_telp,
            ]);
        });

        return redirect()->route('users.index')->with('success', 'Akun OSIS ' . $request->nama_osis . ' berhasil dibuat!');
    }

    /**
     * PROSES SIMPAN DATA ORANG TUA
     */
    public function storeOrtu(Request $request)
    {
        $request->validate([
            'nik_ortu'   => 'required|string|unique:orang_tua,nik_ortu',
            'nama_ortu'  => 'required|string|max:150',
            'nama_anak'  => 'required|string|max:150',
            'kelas_anak' => 'required|string|max:50',
            'no_telp'    => 'nullable|string',
            'alamat'     => 'nullable|string',
        ]);

        $firstWord = Str::slug(explode(' ', $request->nama_ortu)[0], '_');
        $usernameGenerated = $firstWord . '_ortu';

        if (User::where('username', $usernameGenerated)->exists()) {
            $usernameGenerated = $firstWord . '_' . Str::lower(Str::random(3)) . '_ortu';
        }

        DB::transaction(function () use ($request, $usernameGenerated) {
            $user = User::create([
                'name'     => $request->nama_ortu,
                'username' => $usernameGenerated,
                'password' => Hash::make('12345678'),
                'role'     => 'ortu',
            ]);

            OrangTua::create([
                'nik_ortu'      => $request->nik_ortu,
                'id_user'       => $user->id,
                'nama_ortu'     => $request->nama_ortu,
                'nama_anak'     => $request->nama_anak,
                'kelas_anak'    => $request->kelas_anak,
                'no_telp_ortu'  => $request->no_telp,
                'alamat_ortu'   => $request->alamat,
            ]);
        });

        return redirect()->route('users.index')->with('success', 'Akun Orang Tua ' . $request->nama_ortu . ' berhasil dibuat!');
    }

    /**
     * PROSES SIMPAN DATA ADMIN
     */
    // ... Fungsi-fungsi lain di bagian atas tetap biarkan saja ...

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'nama_admin'    => 'required|string|max:150',
            'jabatan_admin' => 'required|string|max:100',
            'no_telp'       => 'nullable|string',
            'alamat'        => 'nullable|string',
        ]);

        $firstWord = Str::slug(explode(' ', $request->nama_admin)[0], '_');
        $usernameGenerated = $firstWord . '_admin';

        if (User::where('username', $usernameGenerated)->exists()) {
            $usernameGenerated = $firstWord . '_' . Str::lower(Str::random(3)) . '_admin';
        }

        DB::transaction(function () use ($request, $usernameGenerated) {
            $user = User::create([
                'name'     => $request->nama_admin,
                'username' => $usernameGenerated,
                'password' => Hash::make('12345678'),
                'role'     => 'admin',
            ]);

            AdminProfile::create([
                'id_user'       => $user->id,
                'nama_admin'    => $request->nama_admin,
                'jabatan_admin' => $request->jabatan_admin,
                'no_telp_admin' => $request->no_telp,
                'alamat_admin'  => $request->alamat,
            ]);
        });

        return redirect()->route('users.index')->with('success', 'Akun Admin ' . $request->nama_admin . ' berhasil dibuat!');
    } // <-- Batas akhir fungsi storeAdmin kamu

    /**
     * Menampilkan halaman form input prestasi kompetisi (Dinamis Array)
     */
    public function createPrestasi()
{
    // Cukup ambil data user yang rolenya siswa, sertakan relasi profil siswanya jika ada
    $allUsers = \App\Models\User::with('siswa')->where('role', 'siswa')->get(); 
    
    return view('input-prestasi', compact('allUsers'));
}
    /**
     * PROSES HAPUS SISWA
     */
    public function destroySiswa($nis)
    {
        $siswa = Siswa::findOrFail($nis);
        User::destroy($siswa->user_id); 
        return redirect()->route('users.index')->with('success', 'Akun pengguna berhasil dihapus dari sistem.');
    }

    /**
     * AUTENTIKASI LOGIN PROCESS
     */
    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'siswa') {
                return redirect()->route('dashboard.siswa')->with('success', 'Selamat datang kembali!');
            } 
            return redirect()->route('dashboard')->with('success', 'Berhasil login ke sistem.');
        }

        return redirect()->back()->withErrors([
            'loginError' => 'Username atau password salah.',
        ])->withInput();
    }
}
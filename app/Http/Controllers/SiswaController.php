<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Kelas;

class SiswaController extends Controller
{
    
public function index()
{
    // 1. Ambil semua data siswa beserta relasi user-nya
    $students = Siswa::with('user')->get();

    // 2. Ambil semua data kelas dari database untuk dropdown modal
    $kelas = Kelas::all(); 

    // 3. Lempar kedua data tersebut ke dalam view 'users'
    return view('users', compact('students', 'kelas'));
}
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nama_lengkap' => 'required|string|max:150',
            'kelas' => 'required|string|max:50',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string|max:15',
        ]);

        // LOGIKA OTOMATIS GENERATE USERNAME
        $firstWord = Str::slug(explode(' ', $request->nama_lengkap)[0], '_');
        $usernameGenerated = $firstWord . '_siswa';

        if (User::where('username', $usernameGenerated)->exists()) {
            $usernameGenerated = $firstWord . '_' . Str::lower(Str::random(3)) . '_siswa';
        }

        DB::transaction(function () use ($request, $usernameGenerated) {
            // 1. Buat Akun User
            $user = User::create([
                'name' => $request->nama_lengkap,
                'username' => $usernameGenerated,
                'password' => Hash::make($request->nis), // Password otomatis dari NIS
                'role' => 'siswa',
            ]);

            // 2. Buat Data Siswa
            Siswa::create([
                'nis' => $request->nis,
                'user_id' => $user->id,
                'nama_lengkap' => $request->nama_lengkap,
                'kelas' => $request->kelas,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);
        });

        return redirect()->back()->with('success', 'Akun Siswa berhasil dibuat otomatis oleh sistem!');
    }

    public function destroy($nis)
    {
        $siswa = Siswa::findOrFail($nis);
        User::destroy($siswa->user_id); // Otomatis menghapus data siswa karena cascade delete

        return redirect()->back()->with('success', 'Akun siswa berhasil dihapus.');
    }

    public function storeWalas(Request $request)
{
    // Sementara kita balikkan redirect back dulu agar aman saat diklik
    return redirect()->back()->with('success', 'Form Wali Kelas berhasil terhubung!');
}
public function loginProcess(Request $request)
{
    // 1. Validasi input dari form login
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    // 2. Proses Autentikasi Menggunakan Auth Laravel
    if (Auth::attempt($credentials)) {
        // Jika login berhasil, buat ulang session biar aman
        $request->session()->regenerate();

        // 3. Cek Role Pengguna untuk Pengalihan Halaman
        $user = Auth::user();
        
        if ($user->role === 'siswa') {
            // Jika rolenya siswa, lempar ke dashboard khusus siswa
            return redirect()->route('dashboard.siswa')->with('success', 'Selamat datang kembali!');
        } 
        
        // Jika rolenya admin atau walas, lempar ke dashboard utama SisPoint
        return redirect()->route('dashboard')->with('success', 'Berhasil login ke sistem admin.');
    }

    // 4. Jika username atau password salah, kembalikan ke halaman login dengan pesan error
    return redirect()->back()->withErrors([
        'loginError' => 'Username atau password yang kamu masukkan salah.',
    ])->withInput();
}
}
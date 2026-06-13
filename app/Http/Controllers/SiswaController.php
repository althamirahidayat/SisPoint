<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Str;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\GuruBk;
use App\Models\Osis;
use App\Models\OrangTua;
use App\Models\AdminProfile;
use App\Models\WaliKelas;
use App\Models\PrestasiSiswa;
class SiswaController extends Controller
{

    public function loginView()
{
    return view('login'); // Pastikan ada file resources/views/login.blade.php
}
    // --- UTILITY: Generate Username Otomatis ---
    private function generateUsername($name, $role) 
{
    // Menggunakan \Illuminate\Support\Str langsung untuk menghindari masalah namespace
    $slug = \Illuminate\Support\Str::slug(explode(' ', $name)[0], '_');
    $username = $slug . '_' . $role;
    
    // Menggunakan \App\Models\User langsung
    return \App\Models\User::where('username', $username)->exists() 
        ? $slug . '_' . \Illuminate\Support\Str::lower(\Illuminate\Support\Str::random(3)) . '_' . $role 
        : $username;
}

    // --- VIEW: List Users ---    
    public function index(Request $request)      
    {
        $search = $request->input('search');
        $filterRole = $request->input('role');
        
        $userQuery = User::with(['siswa', 'guruBk', 'osis', 'orangTua', 'adminProfile']);

        if ($search) {
            $userQuery->where(fn($q) => $q->where('name', 'like', "%$search%")->orWhere('username', 'like', "%$search%"));
        }
        if ($filterRole) $userQuery->where('role', $filterRole);

        return view('users', [
            'allUsers' => $userQuery->latest()->get(),
            'kelas' => Kelas::all()
        ]);
    }

    // --- STORE: Semua Role ---
    public function storeSiswa(Request $request) {
        $request->validate(['nis' => 'required|unique:siswa,nis', 'nama_lengkap' => 'required', 'kelas' => 'required']);
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->nama_lengkap, 'username' => $this->generateUsername($request->nama_lengkap, 'siswa'),
                'password' => Hash::make($request->nis), 'role' => 'siswa'
            ]);
            Siswa::create(array_merge($request->only(['nis', 'nama_lengkap', 'kelas', 'alamat', 'no_telp']), ['user_id' => $user->id]));
        });
        return back()->with('success', 'Akun Siswa dibuat!');
    }

    public function storeWalas(Request $request) {
        $request->validate(['nip' => 'required', 'nama' => 'required', 'kelas_binaan' => 'required']);
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->nama, 'username' => $this->generateUsername($request->nama, 'walas'),
                'password' => Hash::make('12345678'), 'role' => 'walas'
            ]);
            WaliKelas::create([
                'nip_walas' => $request->nip, 'id_user' => $user->id, 'nama_walas' => $request->nama, 
                'kelas_binaan' => $request->kelas_binaan, 'no_telp_walas' => $request->no_telp
            ]);
        });
        return back()->with('success', 'Akun Wali Kelas dibuat!');
    }

    public function storeBk(Request $request) {
        $request->validate(['nip_bk' => 'required|unique:guru_bk,nip_bk', 'nama_bk' => 'required']);
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->nama_bk, 'username' => $this->generateUsername($request->nama_bk, 'guru_bk'),
                'password' => Hash::make('12345678'), 'role' => 'guru_bk'
            ]);
            GuruBk::create(['nip_bk' => $request->nip_bk, 'id_user' => $user->id, 'nama_bk' => $request->nama_bk]);
        });
        return back()->with('success', 'Akun Guru BK dibuat!');
    }

    public function storeOsis(Request $request) {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->nama_osis, 'username' => $this->generateUsername($request->nama_osis, 'osis'),
                'password' => Hash::make('12345678'), 'role' => 'osis'
            ]);
            Osis::create(['id_user' => $user->id, 'nama_osis' => $request->nama_osis, 'kelas_osis' => $request->kelas_osis]);
        });
        return back()->with('success', 'Akun OSIS dibuat!');
    }

    public function storeOrtu(Request $request) {
        $request->validate(['nik_ortu' => 'required|unique:orang_tua,nik_ortu', 'nama_ortu' => 'required']);
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->nama_ortu, 'username' => $this->generateUsername($request->nama_ortu, 'orang_tua'),
                'password' => Hash::make('12345678'), 'role' => 'orang_tua'
            ]);
            OrangTua::create([
                'nik_ortu' => $request->nik_ortu, 'id_user' => $user->id, 'nama_ortu' => $request->nama_ortu,
                'nama_anak' => $request->nama_anak, 'kelas_anak' => $request->kelas_anak
            ]);
        });
        return back()->with('success', 'Akun Orang Tua dibuat!');
    }

    public function storeAdmin(Request $request) {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name, 'username' => $this->generateUsername($request->name, 'admin'),
                'password' => Hash::make('12345678'), 'role' => 'admin'
            ]);
            AdminProfile::create(['id_user' => $user->id]);
        });
        return back()->with('success', 'Akun Admin dibuat!');
    }

    // --- LOGIN LOGIC ---
    public function loginProcess(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        return match (Auth::user()->role) {

            'admin' => redirect()->route('dashboard'),

            'siswa' => redirect()->route('dashboard.siswa'),

            'walas' => redirect()->route('dashboard'),

            'guru_bk' => redirect()->route('dashboard'),

            'osis' => redirect()->route('dashboard'),

            'ortu' => redirect()->route('dashboard'),

            default => redirect('/login'),
        };
    }

    return back()->withErrors([
        'loginError' => 'Username atau password salah.'
    ]);
}
}
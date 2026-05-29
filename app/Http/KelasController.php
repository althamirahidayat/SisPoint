<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa; // Untuk relasi nampilin daftar siswa di dalam kelas nanti
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $daftar_kelas = Kelas::all();
        return view('direktori_kelas', compact('daftar_kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'wali_kelas' => 'required|string|max:100',
            'angkatan' => 'required|string|max:10',
            'jumlah_siswa' => 'required|integer',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
            'angkatan' => $request->angkatan,
            'jumlah_siswa' => $request->jumlah_siswa,
            'status_kelas' => 'Di Sekolah', // Bawaan awal
        ]);

        return redirect()->back()->with('success', 'Kelas baru berhasil didaftarkan ke direktori!');
    }

    // Fitur Ganti Status Kelas (PKL / Di Sekolah) tanpa ribet
    public function updateStatus($id, Request $request)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->status_kelas = $request->status_kelas;
        $kelas->save();

        return redirect()->back()->with('success', 'Status posisi kelas ' . $kelas->nama_kelas . ' berhasil diperbarui!');
    }
}
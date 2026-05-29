<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa; // <-- 1. IMPORT: Menambahkan model Siswa untuk mengambil biodata murid
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $daftar_kelas = Kelas::all();
        return view('direktori_kelas', compact('daftar_kelas'));
    }

    // FUNGSI DETAIL KELAS & DAFTAR ANAK-ANAK (SUDAH DIPERBAIKI)
    public function show($id)
    {
        // Mengambil data kelas berdasarkan primary key 'id_kelas'
        $kelas = Kelas::where('id_kelas', $id)->firstOrFail();
        
        // 2. PERBAIKAN QUERY: Mencari ke model Siswa berdasarkan string nama_kelas
        // Dilengkapi dengan eager loading '.with(user)' jika nanti butuh data loginnya
        $siswa = Siswa::with('user')
                      ->where('kelas', $kelas->nama_kelas)
                      ->get(); 

        // 3. PERBAIKAN COMPACT: Diubah menjadi string 'siswa' (bukan menggunakan variabel $siswa)
        return view('detail_kelas', compact('kelas', 'siswa'));
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
            'status_kelas' => 'Di Sekolah',
        ]);

        return redirect()->back()->with('success', 'Kelas baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'wali_kelas' => 'required|string|max:100',
            'angkatan' => 'required|string|max:10',
            'jumlah_siswa' => 'required|integer',
        ]);

        $kelas = Kelas::where('id_kelas', $id)->firstOrFail();
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'wali_kelas' => $request->wali_kelas,
            'angkatan' => $request->angkatan,
            'jumlah_siswa' => $request->jumlah_siswa,
        ]);

        return redirect()->back()->with('success', 'Data kelas berhasil diperbarui!');
    }

    public function updateStatus($id, Request $request)
    {
        $kelas = Kelas::where('id_kelas', $id)->firstOrFail();
        $kelas->status_kelas = $request->status_kelas;
        $kelas->save();

        return redirect()->back()->with('success', 'Status posisi lokasi kelas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kelas = Kelas::where('id_kelas', $id)->firstOrFail();
        $kelas->delete();

        return redirect()->back()->with('success', 'Kelas berhasil dihapus permanen.');
    }
}
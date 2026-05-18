<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViolationCategory; // Pastikan nama Model kamu sesuai

class ViolationCategoryController extends Controller
{
    /**
     * Menampilkan data ke tabel utama
     */
    public function index()
    {
        // Mengambil semua data jenis pelanggaran dari database
        $categories = ViolationCategory::all();
        
        // Mengirim data ke file view resources/views/violation_categories/index.blade.php
        return view('violation_categories.index', compact('categories'));
    }

    /**
     * Memproses Tambah Data Baru
     */
    public function store(Request $request)
    {
        // Validasi input data dari form modal
        $request->validate([
            'name' => 'required|string|max:255',
            'points' => 'required|integer|min:1',
            'category' => 'required|in:RINGAN,SEDANG,BERAT',
        ]);

        // Menyimpan ke database
        ViolationCategory::create([
            'name' => $request->name,
            'points' => $request->points,
            'category' => $request->category,
            'is_active' => true, // Default otomatis aktif saat dibuat
        ]);

        // Kembali ke halaman sebelumya dengan pesan sukses
        return redirect()->route('violation-categories.index')->with('success', 'Jenis pelanggaran berhasil ditambahkan!');
    }

    /**
     * Memproses Update / Edit Data
     */
    public function update(Request $request, $id)
    {
        // Validasi input edit
        $request->validate([
            'name' => 'required|string|max:255',
            'points' => 'required|integer|min:1',
            'category' => 'required|in:RINGAN,SEDANG,BERAT',
        ]);

        // Mencari data berdasarkan ID yang di-klik
        $category = ViolationCategory::findOrFail($id);
        
        // Mengupdate data di database
        $category->update([
            'name' => $request->name,
            'points' => $request->points,
            'category' => $request->category,
        ]);

        return redirect()->route('violation-categories.index')->with('success', 'Jenis pelanggaran berhasil diubah!');
    }

    /**
     * Memproses Hapus Data
     */
    public function destroy($id)
    {
        // Mencari data berdasarkan ID lalu menghapusnya
        $category = ViolationCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('violation-categories.index')->with('success', 'Jenis pelanggaran berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\JenisApresiasi; 
use Illuminate\Http\Request;

class JenisApresiasiController extends Controller
{
    public function index()
    {
        // Variabel diubah menjadi $appreciations agar sesuai dengan @foreach di view
        $appreciations = JenisApresiasi::all(); 
        
        return view('apresiasi', compact('appreciations'));
    }

    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'name' => 'required|string|max:255',
        'points' => 'required|integer',
        'category' => 'required|string',
    ]);

    // Simpan ke database
    JenisApresiasi::create([
        'nama_apresiasi' => $request->name,
        'poin' => $request->points,
        // Sesuaikan dengan nama kolom di tabel kamu
    ]);

    return redirect()->route('apresiasi.index')->with('success', 'Data apresiasi berhasil ditambah!');
}
}
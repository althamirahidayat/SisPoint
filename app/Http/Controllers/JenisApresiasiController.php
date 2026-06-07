<?php

namespace App\Http\Controllers;

use App\Models\JenisApresiasi; // Pastikan Model ini sudah ada
use Illuminate\Http\Request;

class JenisApresiasiController extends Controller
{
    public function index()
    {
        // Mengambil semua data apresiasi
        $data = JenisApresiasi::all(); 
        
        // Mengirim data ke view 'apresiasi.index'
        return view('apresiasi.index', compact('data'));
    }
}
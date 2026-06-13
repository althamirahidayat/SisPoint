<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    protected $table = 'wali_kelas'; // Pastikan sudah diset jika nama tabel berbeda

    // Tambahkan baris di bawah ini:
    protected $fillable = [
        'nip_walas', 
        'id_user', 
        'nama_walas', 
        'kelas_binaan', 
        'no_telp_walas'
    ];
}
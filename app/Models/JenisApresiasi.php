<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisApresiasi extends Model
{
    // Tambahkan baris ini agar Eloquent mencari tabel 'jenis_apresiasi' 
    // bukan 'jenis_apresiasis'
    protected $table = 'jenis_apresiasi';

    protected $guarded = [];
}
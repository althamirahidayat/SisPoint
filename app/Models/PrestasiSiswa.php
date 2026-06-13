<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    // Sesuaikan dengan nama tabel yang ada di database kamu
    protected $table = 'prestasi_siswas'; 

    // Sesuaikan daftar field dengan kolom yang ada di tabel database tersebut
    protected $fillable = [
        'user_id', 
        'name', 
        'category', 
        'points', 
        'is_active'
    ];
}
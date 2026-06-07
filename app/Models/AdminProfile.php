<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Ini sudah benar
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory; // <-- UBAH DI SINI (Sebelumnya: use Factory;)

    protected $table = 'admin_profiles';

    protected $fillable = [
        'id_user',
        'nama_admin',
        'jabatan_admin',
        'no_telp_admin',
        'alamat_admin',
    ];
}
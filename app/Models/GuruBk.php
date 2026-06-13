<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruBk extends Model
{
    protected $table = 'guru_bk'; // Pastikan nama tabel benar

    // Tambahkan baris ini
    protected $fillable = [
        'nip_bk', 
        'id_user', 
        'nama_bk'
    ];
}
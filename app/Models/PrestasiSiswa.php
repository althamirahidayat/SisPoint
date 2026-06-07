<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'perlombaan_id',
        'user_id',
        'kemenangan',
        'poin_tambahan'
    ];

    // Relasi balik ke data Perlombaan Master
    public function perlombaan()
    {
        return $this->belongsTo(Perlombaan::class, 'perlombaan_id');
    }

    // Relasi ke tabel User/Siswa untuk mengambil nama/NIS murid
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
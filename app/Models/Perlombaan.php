<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perlombaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lomba',
        'kategori',
        'tanggal_pengumuman',
        'lampiran'
    ];

    // Relasi ke tabel detail pemenang
    public function prestasiSiswas()
    {
        return $this->hasMany(PrestasiSiswa::class, 'perlombaan_id');
    }
}
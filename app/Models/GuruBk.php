<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruBk extends Model
{
    use HasFactory;

    protected $table = 'guru_bk';
    protected $primaryKey = 'nip_bk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip_bk',
        'id_user',
        'nama_bk',
        'no_telp_bk',
        'alamat_bk',
    ];

    // Relasi balik ke tabel Users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
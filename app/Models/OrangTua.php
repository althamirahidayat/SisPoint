<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tua';
    protected $primaryKey = 'nik_ortu';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nik_ortu',
        'id_user',
        'nama_ortu',
        'nama_anak',
        'kelas_anak',
        'alamat_ortu',
        'no_telp_ortu',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
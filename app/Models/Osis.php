<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Osis extends Model
{
    use HasFactory;

    protected $table = 'osis';

    protected $fillable = [
        'id_user',
        'nama_osis',
        'kelas_osis',
        'no_telp_osis',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
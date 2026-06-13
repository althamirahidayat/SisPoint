<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{

    protected $table = 'orang_tua';

    protected $fillable = ['nik_ortu', 'id_user', 'nama_ortu', 'nama_anak', 'kelas_anak'];
}
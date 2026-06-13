<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    // Arahkan ke tabel yang sudah ada di database kamu
    protected $table = 'prestasi_siswas'; 

    protected $guarded = [];
}
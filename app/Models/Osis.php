<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Osis extends Model
{
    protected $table = 'osis';
    protected $guarded = []; // Agar tidak error saat mass assignment

    // Ganti 'id_user' dengan nama kolom asli di tabel 'osis' kamu
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
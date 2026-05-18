<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViolationCategory extends Model
{
    use HasFactory;

    // Daftarkan kolom database yang boleh diisi lewat form
    protected $fillable = ['name', 'category', 'points', 'is_active'];
}
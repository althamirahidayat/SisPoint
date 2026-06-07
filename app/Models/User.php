<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Siswa; 
use App\Models\GuruBk;
use App\Models\Osis;
use App\Models\OrangTua;
use App\Models\AdminProfile;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * ==========================================
     * PUSAT RELASI MULTI-ROLE (ONE-TO-ONE)
     * ==========================================
     */

    // Relasi ke Siswa (Menggunakan FK: user_id)
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }

    // Relasi ke Wali Kelas (Menggunakan tabel wali_kelas & FK: id_user)
    public function waliKelas()
    {
        return $this->hasOne(User::class, 'id_user', 'id'); 
        // Catatan: Jika kamu membuat model khusus bernama WaliKelas, ganti menjadi:
        // return $this->hasOne(WaliKelas::class, 'id_user', 'id');
    }

    // Relasi ke Guru BK (Menggunakan FK: id_user)
    public function guruBk()
    {
        return $this->hasOne(GuruBk::class, 'id_user', 'id');
    }

    // Relasi ke Pengurus OSIS (Menggunakan FK: id_user)
    public function osis()
    {
        return $this->hasOne(Osis::class, 'id_user', 'id');
    }

    // Relasi ke Orang Tua / Wali Murid (Menggunakan FK: id_user)
    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'id_user', 'id');
    }

    // Relasi ke Profil Admin (Menggunakan FK: id_user)
    public function adminProfile()
    {
        return $this->hasOne(AdminProfile::class, 'id_user', 'id');
    }
}
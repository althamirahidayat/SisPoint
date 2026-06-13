<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['username', 'name', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];
    protected function casts(): array { return ['password' => 'hashed']; }

    // Relasi yang sudah disesuaikan dengan pola id_user
public function siswa() { return $this->hasOne(Siswa::class, 'user_id', 'id'); }
public function waliKelas() { return $this->hasOne(WaliKelas::class, 'id_user', 'id'); } 
public function guruBk() { return $this->hasOne(GuruBk::class, 'id_user', 'id'); }
public function osis() { return $this->hasOne(Osis::class, 'id_user', 'id'); }
public function orangTua() { return $this->hasOne(OrangTua::class, 'id_user', 'id'); }
public function adminProfile() { return $this->hasOne(AdminProfile::class, 'id_user', 'id'); }
}
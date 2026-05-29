<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas'); // Primary Key sesuai ERD kamu
            $table->string('nama_kelas');
            $table->string('wali_kelas');
            $table->string('angkatan');
            $table->integer('jumlah_siswa')->default(0);
            $table->enum('status_kelas', ['Di Sekolah', 'PKL'])->default('Di Sekolah'); // Status dinamis
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestasi_siswas', function (Blueprint $table) {
            $table->id(); // Primary Key
            
            // Foreign Key ke tabel perlombaans. 
            // cascadeOnDelete() artinya jika data lomba dihapus, data detail pemenang di tabel ini ikut terhapus otomatis.
            $table->foreignId('perlombaan_id')
                  ->constrained('perlombaans')
                  ->cascadeOnDelete();
            
            // Foreign Key ke tabel users (akun siswa)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('kemenangan'); // Juara 1, Juara 2, Juara Harapan, dst
            $table->integer('poin_tambahan')->default(0); // Poin tambahan untuk Leaderboard
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestasi_siswas');
    }
};
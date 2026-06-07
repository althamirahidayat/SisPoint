<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perlombaans', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nama_lomba');
            $table->string('kategori'); // Akademik atau Non-Akademik
            $table->date('tanggal_pengumuman');
            $table->string('lampiran')->nullable(); // Menyimpan path foto/sertifikat (nullable jika opsional)
            $table->timestamps(); // Auto create created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perlombaans');
    }
};
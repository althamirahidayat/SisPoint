<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void 
    {
        Schema::create('wali_kelas', function (Blueprint $table) {
            $table->string('nip_walas')->primary(); // NIP sebagai Primary Key sesuai PDM
            $table->unsignedBigInteger('id_user');  // Menghubungkan relasi akun login ke tabel users
            $table->string('nama_walas', 150);
            $table->string('kelas_binaan');
            $table->string('no_telp_walas')->nullable();
            $table->text('alamat_walas')->nullable();
            $table->timestamps();

            // Setup Foreign Key agar data terikat aman dengan tabel users
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali_kelas');
    }
};
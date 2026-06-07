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
    Schema::create('guru_bk', function (Blueprint $table) {
        $table->string('nip_bk', 30)->primary(); // NIP jadi Primary Key
        $table->unsignedBigInteger('id_user'); // Menghubungkan ke tabel users
        $table->string('nama_bk', 150);
        $table->string('no_telp_bk', 15)->nullable();
        $table->text('alamat_bk')->nullable();
        $table->timestamps();

        // Relasi Foreign Key: Jika user di-delete, profil BK otomatis ikut terhapus
        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_bk');
    }
};

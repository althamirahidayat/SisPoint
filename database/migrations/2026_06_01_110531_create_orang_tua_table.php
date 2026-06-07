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
    Schema::create('orang_tua', function (Blueprint $table) {
        $table->string('nik_ortu', 30)->primary(); // NIK jadi Primary Key
        $table->unsignedBigInteger('id_user');
        $table->string('nama_ortu', 150);
        $table->string('nama_anak', 150);
        $table->string('kelas_anak', 50);
        $table->text('alamat_ortu')->nullable();
        $table->string('no_telp_ortu', 15)->nullable();
        $table->timestamps();

        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tua');
    }
};

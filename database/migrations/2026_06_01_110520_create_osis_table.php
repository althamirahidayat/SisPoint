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
    Schema::create('osis', function (Blueprint $table) {
        $table->id(); // Karena siswa OSIS tidak punya NIP/NIS khusus organisasi, pakai Auto Increment ID
        $table->unsignedBigInteger('id_user');
        $table->string('nama_osis', 150);
        $table->string('kelas_osis', 50);
        $table->string('no_telp_osis', 15)->nullable();
        $table->timestamps();

        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('osis');
    }
};

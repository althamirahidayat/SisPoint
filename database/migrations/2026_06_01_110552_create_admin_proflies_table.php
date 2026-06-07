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
    Schema::create('admin_profiles', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_user');
        $table->string('nama_admin', 150);
        $table->string('jabatan_admin', 100);
        $table->string('no_telp_admin', 15)->nullable();
        $table->text('alamat_admin')->nullable();
        $table->timestamps();

        $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_proflies');
    }
};

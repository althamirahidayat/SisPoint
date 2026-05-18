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
    Schema::create('violation_categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');      // Untuk "Terlambat masuk sekolah"
        $table->integer('points');    // Untuk angka poinnya (misal: 5, 10)
        $table->string('category');  // Untuk "RINGAN", "SEDANG", atau "BERAT"
        $table->boolean('is_active')->default(true); // Untuk status AKTIF (hijau) di tabel
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violation_categories');
    }
};

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
    Schema::table('users', function (Blueprint $table) {
        // Menambahkan kolom total_prestasi dengan nilai default 0
        $table->integer('total_prestasi')->default(0)->after('email'); 
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Menghapus kolom jika migrasi di-rollback
        $table->dropColumn('total_prestasi');
    });
}

    /**
     * Reverse the migrations.
     */
   
};

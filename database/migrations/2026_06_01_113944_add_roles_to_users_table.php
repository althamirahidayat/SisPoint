<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Menggunakan Query Builder mentah karena mengganti ENUM langsung di Laravel membutuhkan package doctrine/dbal
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'walas', 'siswa', 'bk', 'osis', 'ortu') NOT NULL");
    }

    public function down(): void
    {
        // Kembalikan ke struktur awal jika di-rollback
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'walas', 'siswa') NOT NULL");
    }
};
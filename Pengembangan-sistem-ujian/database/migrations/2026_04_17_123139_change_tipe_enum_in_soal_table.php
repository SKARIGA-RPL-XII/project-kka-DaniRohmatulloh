<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE soal MODIFY COLUMN tipe ENUM('pilihan_ganda','essay') NOT NULL DEFAULT 'pilihan_ganda'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE soal MODIFY COLUMN tipe ENUM('pg','essay') NOT NULL DEFAULT 'pg'");
    }
};

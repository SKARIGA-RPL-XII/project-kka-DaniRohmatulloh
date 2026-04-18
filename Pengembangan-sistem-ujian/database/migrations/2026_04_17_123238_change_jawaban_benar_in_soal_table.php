<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE soal MODIFY COLUMN jawaban_benar VARCHAR(255) NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE soal MODIFY COLUMN jawaban_benar ENUM('A','B','C','D') NOT NULL");
    }
};

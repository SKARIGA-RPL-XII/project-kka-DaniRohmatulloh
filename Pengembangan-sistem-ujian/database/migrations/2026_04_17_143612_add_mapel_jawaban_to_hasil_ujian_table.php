<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_ujian', function (Blueprint $table) {
            // Buat ujian_id nullable agar bisa simpan hasil tanpa ujian formal
            $table->unsignedBigInteger('ujian_id')->nullable()->change();
            $table->unsignedBigInteger('mapel_id')->nullable()->after('ujian_id');
            $table->json('jawaban')->nullable()->after('nilai');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_ujian', function (Blueprint $table) {
            $table->dropColumn(['mapel_id', 'jawaban']);
        });
    }
};

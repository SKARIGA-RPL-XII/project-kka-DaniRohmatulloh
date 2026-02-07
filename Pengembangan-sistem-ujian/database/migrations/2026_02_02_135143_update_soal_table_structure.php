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
        Schema::table('soal', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('soal', 'nomor')) {
                $table->integer('nomor')->after('mapel_id');
            }
            if (!Schema::hasColumn('soal', 'pertanyaan')) {
                $table->text('pertanyaan')->after('nomor');
            }
            if (!Schema::hasColumn('soal', 'opsi_a')) {
                $table->string('opsi_a')->after('pertanyaan');
            }
            if (!Schema::hasColumn('soal', 'opsi_b')) {
                $table->string('opsi_b')->after('opsi_a');
            }
            if (!Schema::hasColumn('soal', 'opsi_c')) {
                $table->string('opsi_c')->after('opsi_b');
            }
            if (!Schema::hasColumn('soal', 'opsi_d')) {
                $table->string('opsi_d')->after('opsi_c');
            }
            if (!Schema::hasColumn('soal', 'jawaban_benar')) {
                $table->enum('jawaban_benar', ['A','B','C','D'])->after('opsi_d');
            }
            if (!Schema::hasColumn('soal', 'tipe')) {
                $table->enum('tipe', ['pg','essay'])->default('pg')->after('jawaban_benar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soal', function (Blueprint $table) {
            $table->dropColumn(['nomor', 'pertanyaan', 'opsi_a', 'opsi_b', 'opsi_c', 'opsi_d', 'jawaban_benar', 'tipe']);
        });
    }
};

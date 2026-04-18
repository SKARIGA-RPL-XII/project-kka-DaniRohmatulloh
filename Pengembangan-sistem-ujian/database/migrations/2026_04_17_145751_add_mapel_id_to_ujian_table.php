<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ujian', function (Blueprint $table) {
            $table->unsignedBigInteger('mapel_id')->nullable()->after('id');
            $table->string('nama_ujian')->nullable()->change();
            $table->integer('durasi')->nullable()->change();
            $table->date('tanggal')->nullable()->change();
            $table->time('jam_mulai')->nullable()->change();
            $table->time('jam_selesai')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('ujian', function (Blueprint $table) {
            $table->dropColumn('mapel_id');
        });
    }
};

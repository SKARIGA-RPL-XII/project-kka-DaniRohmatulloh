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
        Schema::create('hasil_ujian', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('murid_id');
    $table->unsignedBigInteger('ujian_id');
    $table->integer('nilai')->nullable();
    $table->string('status')->nullable();
    $table->timestamps();

    // optional relasi (kalau tabelnya ada)
    $table->foreign('ujian_id')->references('id')->on('ujian')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_ujian');
    }
};

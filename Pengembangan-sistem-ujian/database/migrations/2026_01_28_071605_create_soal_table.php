<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->id();
$table->unsignedBigInteger('mapel_id')->nullable()->index();
            $table->integer('nomor');
            $table->text('pertanyaan');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->enum('jawaban_benar', ['A','B','C','D']);
            $table->enum('tipe', ['pg','essay'])->default('pg');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('soal');
    }
};
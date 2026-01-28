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
            $table->enum('type', ['pg', 'uraian']);
            $table->text('question');
            $table->unsignedBigInteger('subject_id');
            $table->json('options')->nullable();
            $table->string('correct_answer')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->enum('status', ['pending', 'review', 'aktif'])->default('review');
            $table->timestamps();
            
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('soal');
    }
};
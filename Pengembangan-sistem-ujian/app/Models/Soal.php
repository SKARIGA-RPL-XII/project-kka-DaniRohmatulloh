<?php
// app/Models/Soal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';
    protected $fillable = [
        'mapel_id', 'tipe', 'nomor', 'pertanyaan', 
        'sub_questions', 'opsi_a', 'opsi_b', 'opsi_c', 
        'opsi_d', 'jawaban_benar'
    ];

    protected $casts = [
        'sub_questions' => 'array',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }
}
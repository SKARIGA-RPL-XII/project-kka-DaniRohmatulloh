<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';

    protected $fillable = [
        'mapel_id',
        'nama_ujian',
        'durasi',
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }

    public function hasilUjian()
    {
        return $this->hasMany(HasilUjian::class);
    }
}
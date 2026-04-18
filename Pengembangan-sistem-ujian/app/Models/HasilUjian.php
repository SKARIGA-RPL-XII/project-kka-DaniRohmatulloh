<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MataPelajaran;

class HasilUjian extends Model
{
    protected $table = 'hasil_ujian';

    protected $fillable = [
        'murid_id',
        'ujian_id',
        'mapel_id',
        'nilai',
        'jawaban',
    ];

    protected $casts = [
        'jawaban' => 'array',
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }

    public function murid()
    {
        return $this->belongsTo(User::class, 'murid_id');
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
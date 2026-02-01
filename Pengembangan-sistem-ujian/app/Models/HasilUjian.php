<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    protected $table = 'hasil_ujian';

    protected $fillable = [
        'murid_id',
        'ujian_id',
        'nilai',
    ];

    public function murid()
    {
        return $this->belongsTo(User::class, 'murid_id');
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
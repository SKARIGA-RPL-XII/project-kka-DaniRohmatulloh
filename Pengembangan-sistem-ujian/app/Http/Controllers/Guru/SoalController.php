<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'mapel_id' => 'required',
        'pertanyaan' => 'required',
        'opsi_a' => 'required',
        'opsi_b' => 'required',
        'opsi_c' => 'required',
        'opsi_d' => 'required',
        'jawaban_benar' => 'required',
    ]);

    Soal::create([
        'mapel_id' => $request->mapel_id,
        'pertanyaan' => $request->pertanyaan,
        'opsi_a' => $request->opsi_a,
        'opsi_b' => $request->opsi_b,
        'opsi_c' => $request->opsi_c,
        'opsi_d' => $request->opsi_d,
        'jawaban' => $request->jawaban_benar,
    ]);

    // 🔥 LOGIKA PINDAH KE LARAVEL
    if ($request->action === 'save_add') {
        return redirect()
            ->back()
            ->with('success', 'Soal berhasil disimpan, silakan tambah soal baru');
    }

    return redirect()
        ->route('guru.soal.index')
        ->with('success', 'Soal berhasil disimpan');
}
}

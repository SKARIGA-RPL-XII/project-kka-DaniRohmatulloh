<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KirimUjianController extends Controller
{
    public function kirimUjian(Request $request)
{
    // Validasi minimal 10 soal
    $soalIds = $request->input('soal_ids', []);
    
    if (count($soalIds) < 10) {
        return response()->json(['error' => 'Minimal 10 soal untuk membuat ujian'], 400);
    }
    
    // Buat ujian baru
    $ujian = Ujian::create([
        'mapel_id' => $request->mapel_id,
        'nama_ujian' => 'Ujian ' . now()->format('d/m/Y'),
        'durasi' => 60, // default 60 menit
        'status' => 'active'
    ]);
    
    // Lampirkan soal ke ujian
    $ujian->soals()->attach($soalIds);
    
    return response()->json([
        'success' => true,
        'message' => 'Ujian berhasil dikirim ke siswa',
        'ujian_id' => $ujian->id
    ]);
}
}

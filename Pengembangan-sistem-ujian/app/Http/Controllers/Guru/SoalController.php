<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    public function create()
    {
        $mataPelajaran = MataPelajaran::all();
        $recentSoal = Soal::with('mataPelajaran')->latest()->take(10)->get();
        $totalSoal = Soal::count();
        $soalPG = Soal::where('tipe', 'pilihan_ganda')->count();
        $soalEssay = Soal::where('tipe', 'essay')->count();
        
        return view('guru.Kelola-Soal', compact('mataPelajaran', 'recentSoal', 'totalSoal', 'soalPG', 'soalEssay'));
    }

    public function store(Request $request)
{
    $request->validate([
        'mapel_id' => 'required',
        'pertanyaan' => 'required|array',
        'opsi_a' => 'required|array',
        'opsi_b' => 'required|array',
        'opsi_c' => 'required|array',
        'opsi_d' => 'required|array',
        'jawaban_benar' => 'required|array',
    ]);

    foreach ($request->pertanyaan as $i => $pertanyaan) {
        Soal::create([
            'mapel_id' => $request->mapel_id,
            'nomor' => $request->nomor[$i],
            'pertanyaan' => $pertanyaan,
            'opsi_a' => $request->opsi_a[$i],
            'opsi_b' => $request->opsi_b[$i],
            'opsi_c' => $request->opsi_c[$i],
            'opsi_d' => $request->opsi_d[$i],
            'jawaban_benar' => $request->jawaban_benar[$i],
        ]);
    }

    return redirect()->route('guru.soal.create')->with('success', count($request->pertanyaan) . ' soal berhasil disimpan');
}

    public function deleteSubject($id)
    {
        MataPelajaran::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Mata pelajaran berhasil dihapus']);
    }

    public function addSubject(Request $request)
    {
        $request->validate(['nama_mapel' => 'required']);
        $mapel = MataPelajaran::create(['nama_mapel' => $request->nama_mapel]);
        return response()->json(['success' => true, 'data' => $mapel]);
    }
}

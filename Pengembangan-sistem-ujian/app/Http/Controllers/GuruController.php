<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller {
    public function index() {
        $totalSoal = Soal::count();
        $totalUjian = Ujian::count();
        $totalSiswa = User::where('role', 'murid')->count();
        
        return view('guru.dashboard', compact('totalSoal', 'totalUjian', 'totalSiswa'));
    }

    public function dashboard() {
        $totalSoal = Soal::count();
        $totalUjian = Ujian::count();
        $totalSiswa = User::where('role', 'murid')->count();
        
        return view('guru.dashboard', compact('totalSoal', 'totalUjian', 'totalSiswa'));
    }

    public function examp() {
        $soals = Soal::with('mataPelajaran')->get()->map(function($soal) {
            return [
                'id' => $soal->id,
                'title' => $soal->pertanyaan,
                'subject' => strtolower($soal->mataPelajaran->nama_mapel ?? 'umum'),
                'mapel_id' => $soal->mapel_id,
'type' => $soal->tipe,
                'difficulty' => 'medium',
                'points' => 2,
                'created' => $soal->created_at->format('Y-m-d'),
                'question' => $soal->pertanyaan,
'options' => $soal->tipe === 'pilihan_ganda' ? [
                    $soal->pilihan_a,
                    $soal->pilihan_b,
                    $soal->pilihan_c,
                    $soal->pilihan_d
                ] : null,
                'correct' => $soal->jawaban_benar
            ];
        });

        $ujians = Ujian::with('mataPelajaran')->get()->map(function($ujian) {
            return [
                'id' => $ujian->id,
                'name' => $ujian->nama_ujian,
                'subject' => strtolower($ujian->mataPelajaran->nama_mapel ?? 'umum'),
                'questionCount' => Soal::where('mapel_id', $ujian->mapel_id)->count(),
                'duration' => $ujian->durasi,
                'status' => 'active',
                'created' => $ujian->created_at->format('Y-m-d')
            ];
        });

        $mataPelajaran = \App\Models\MataPelajaran::all();

        return view('guru.examp', compact('soals', 'ujians', 'mataPelajaran'));
    }

    public function saveExam(Request $request) {
        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'durasi' => 'required|integer|min:10|max:300',
        ]);

        $ujian = Ujian::create([
            'nama_ujian' => $request->nama_ujian,
            'mapel_id' => $request->mapel_id,
            'durasi' => $request->durasi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ujian berhasil disimpan dan akan muncul di dashboard murid',
            'ujian' => $ujian
        ]);
    }
}

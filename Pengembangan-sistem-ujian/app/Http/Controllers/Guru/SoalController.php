<?php
// app/Http/Controllers/Guru/SoalController.php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    // app/Http/Controllers/Guru/SoalController.php

public function index()
{
    $mataPelajaran = MataPelajaran::all();
    $soal = Soal::with('mataPelajaran')->orderBy('created_at', 'desc')->get();
    
    $totalSoal = $soal->count();
    $soalPG = $soal->where('tipe', 'pilihan_ganda')->count();
    $soalEssay = $soal->where('tipe', 'essay')->count();
    $recentSoal = $soal;
    
    // Ubah ini sesuai lokasi file blade Anda
    return view('guru.Kelola-Soal', compact(
        'mataPelajaran', 'soal', 'totalSoal', 
        'soalPG', 'soalEssay', 'recentSoal'
    ));
}

    public function store(Request $request)
    {
        // Debug: lihat data yang masuk
        // dd($request->all());
        
        $request->validate([
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'tipe' => 'required|in:pilihan_ganda,essay',
            'pertanyaan_utama' => 'nullable|string',
            'sub_pertanyaan' => 'required|array|min:1',
            'sub_pertanyaan.*' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $subQuestions = [];
            
            if ($request->tipe == 'pilihan_ganda') {
                // Validasi untuk pilihan ganda
                $request->validate([
                    'sub_opsi_a' => 'required|array',
                    'sub_opsi_b' => 'required|array',
                    'sub_opsi_c' => 'required|array',
                    'sub_opsi_d' => 'required|array',
                    'sub_jawaban_benar' => 'required|array',
                ]);

                foreach ($request->sub_pertanyaan as $index => $pertanyaan) {
                    $subQuestions[] = [
                        'nomor' => $index + 1,
                        'pertanyaan' => $pertanyaan,
                        'opsi_a' => $request->sub_opsi_a[$index] ?? '-',
                        'opsi_b' => $request->sub_opsi_b[$index] ?? '-',
                        'opsi_c' => $request->sub_opsi_c[$index] ?? '-',
                        'opsi_d' => $request->sub_opsi_d[$index] ?? '-',
                        'jawaban_benar' => $request->sub_jawaban_benar[$index] ?? 'A',
                    ];
                }
            } 
            else { // Essay
                foreach ($request->sub_pertanyaan as $index => $pertanyaan) {
                    $subQuestions[] = [
                        'nomor' => $index + 1,
                        'pertanyaan' => $pertanyaan,
                        'pedoman_jawaban' => $request->sub_pedoman_jawaban[$index] ?? null,
                    ];
                }
            }

// Get next sequential nomor by finding gap or max+1
$existingSoalCount = Soal::where('mapel_id', $request->mapel_id)->count();
            $nextNomor = $existingSoalCount + 1;
            
            // Simpan ke database
            $soal = Soal::create([
                'mapel_id' => $request->mapel_id,
                'tipe' => $request->tipe,
                'nomor' => $nextNomor,
                'pertanyaan' => $request->pertanyaan_utama ?? 'Soal ' . $nextNomor,
                'sub_questions' => json_encode($subQuestions, JSON_UNESCAPED_UNICODE),
                'opsi_a' => '-',
                'opsi_b' => '-',
                'opsi_c' => '-',
                'opsi_d' => '-',
                'jawaban_benar' => '-',
            ]);

            DB::commit();
            
            return redirect()->route('guru.soal.index')
                ->with('success', 'Soal berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menyimpan soal: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);
        
        $request->validate([
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'tipe' => 'required|in:pilihan_ganda,essay',
            'pertanyaan_utama' => 'required|string',
            'sub_pertanyaan' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();

            $subQuestions = [];
            
            if ($request->tipe == 'pilihan_ganda') {
                foreach ($request->sub_pertanyaan as $index => $pertanyaan) {
                    $subQuestions[] = [
                        'nomor' => $index + 1,
                        'pertanyaan' => $pertanyaan,
                        'opsi_a' => $request->sub_opsi_a[$index] ?? '-',
                        'opsi_b' => $request->sub_opsi_b[$index] ?? '-',
                        'opsi_c' => $request->sub_opsi_c[$index] ?? '-',
                        'opsi_d' => $request->sub_opsi_d[$index] ?? '-',
                        'jawaban_benar' => $request->sub_jawaban_benar[$index] ?? 'A',
                    ];
                }
            } 
            else {
                foreach ($request->sub_pertanyaan as $index => $pertanyaan) {
                    $subQuestions[] = [
                        'nomor' => $index + 1,
                        'pertanyaan' => $pertanyaan,
                        'pedoman_jawaban' => $request->sub_pedoman_jawaban[$index] ?? null,
                    ];
                }
            }

            $soal->update([
                'mapel_id' => $request->mapel_id,
                'tipe' => $request->tipe,
                'pertanyaan' => $request->pertanyaan_utama,
                'sub_questions' => json_encode($subQuestions, JSON_UNESCAPED_UNICODE),
            ]);

            DB::commit();
            
            return redirect()->route('guru.soal.index')
                ->with('success', 'Soal berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal memperbarui soal: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $soal = Soal::findOrFail($id);
        return response()->json([
            'id' => $soal->id,
            'mapel_id' => $soal->mapel_id,
            'tipe' => $soal->tipe,
            'pertanyaan' => $soal->pertanyaan,
            'sub_questions' => $soal->sub_questions,
        ]);
    }

    public function destroy($id)
    {
        try {
            $soal = Soal::findOrFail($id);
            $mapelId = $soal->mapel_id;
            $soal->delete();
            
            // Re-number soal for this mapel_id
            $remainingSoal = Soal::where('mapel_id', $mapelId)
                ->orderBy('created_at')
                ->get();
            
            foreach ($remainingSoal as $index => $s) {
                $s->update(['nomor' => $index + 1]);
            }
            
            return redirect()->route('guru.soal.index')
                ->with('success', 'Soal berhasil dihapus dan nomor diurutkan ulang!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus soal!');
        }
    }
}
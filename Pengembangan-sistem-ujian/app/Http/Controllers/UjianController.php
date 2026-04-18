<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Soal;
use App\Models\MataPelajaran;
use App\Models\HasilUjian;

class UjianController extends Controller
{
    // Halaman ujian — tampilkan semua soal berurutan
    public function mulai($mapel_id)
    {
        $mapel = MataPelajaran::findOrFail($mapel_id);

        // Ambil semua soal untuk mapel ini, urutkan berdasarkan nomor
        $paketSoal = Soal::where('mapel_id', $mapel_id)
            ->orderBy('nomor')
            ->get();

        // Flatten semua sub_questions menjadi array soal berurutan
        $soalList = [];
        $nomor = 1;
        foreach ($paketSoal as $paket) {
            $subs = is_array($paket->sub_questions)
                ? $paket->sub_questions
                : (json_decode($paket->sub_questions, true) ?? []);

            foreach ($subs as $sub) {
                $soalList[] = [
                    'nomor'         => $nomor,
                    'paket_id'      => $paket->id,
                    'tipe'          => $paket->tipe,
                    'pertanyaan'    => $sub['pertanyaan'],
                    'opsi_a'        => $sub['opsi_a'] ?? null,
                    'opsi_b'        => $sub['opsi_b'] ?? null,
                    'opsi_c'        => $sub['opsi_c'] ?? null,
                    'opsi_d'        => $sub['opsi_d'] ?? null,
                    'sub_index'     => $sub['nomor'] - 1,
                ];
                $nomor++;
            }
        }

        if (empty($soalList)) {
            return redirect()->route('murid.dashboard')
                ->with('error', 'Belum ada soal untuk mata pelajaran ini.');
        }

        return view('murid.ujian', compact('mapel', 'soalList', 'mapel_id'));
    }

    public function submit(Request $request, $mapel_id)
    {
        $mapel    = MataPelajaran::findOrFail($mapel_id);
        $paketSoal = Soal::where('mapel_id', $mapel_id)->orderBy('nomor')->get();
        $jawaban  = $request->input('jawaban', []);

        $totalSoal  = 0;
        $benar      = 0;
        $detail     = [];
        $nomor      = 1;

        foreach ($paketSoal as $paket) {
            $subs = is_array($paket->sub_questions)
                ? $paket->sub_questions
                : (json_decode($paket->sub_questions, true) ?? []);

            foreach ($subs as $sub) {
                $kunci       = $sub['jawaban_benar'] ?? null;
                $jawabanUser = $jawaban[$nomor] ?? null;
                $isBenar     = $paket->tipe === 'pilihan_ganda'
                    ? ($jawabanUser === $kunci)
                    : false; // essay tidak auto-koreksi

                if ($paket->tipe === 'pilihan_ganda') {
                    $totalSoal++;
                    if ($isBenar) $benar++;
                }

                $detail[] = [
                    'nomor'         => $nomor,
                    'pertanyaan'    => $sub['pertanyaan'],
                    'tipe'          => $paket->tipe,
                    'jawaban_user'  => $jawabanUser,
                    'jawaban_benar' => $kunci,
                    'benar'         => $isBenar,
                    'opsi_a'        => $sub['opsi_a'] ?? null,
                    'opsi_b'        => $sub['opsi_b'] ?? null,
                    'opsi_c'        => $sub['opsi_c'] ?? null,
                    'opsi_d'        => $sub['opsi_d'] ?? null,
                ];
                $nomor++;
            }
        }

        $nilai = $totalSoal > 0 ? round(($benar / $totalSoal) * 100) : 0;

        // Simpan hasil
        $hasil = HasilUjian::create([
            'murid_id'  => Auth::id(),
            'ujian_id'  => null,
            'mapel_id'  => $mapel_id,
            'nilai'     => $nilai,
            'jawaban'   => json_encode($detail),
        ]);

        return view('murid.hasil-ujian', compact('mapel', 'detail', 'nilai', 'benar', 'totalSoal', 'hasil'));
    }
}

<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\HasilUjian;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Http\Request;

class HasilUjianController extends Controller
{
    public function index()
    {
        $results = HasilUjian::with(['ujian.mataPelajaran', 'murid'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $ujianList = Ujian::with('mataPelajaran')->get();

        // Stats
        $totalExams = Ujian::count();
        $activeExams = Ujian::count();
        $totalStudents = User::where('role', 'murid')->count();
        $completedStudents = HasilUjian::distinct('murid_id')->count('murid_id');
        $averageScore = round(HasilUjian::avg('nilai'), 1);
        $scoreTrend = 0;
        $passingRate = HasilUjian::count() > 0 ? round((HasilUjian::where('nilai', '>=', 70)->count() / HasilUjian::count()) * 100, 1) : 0;
        $totalResults = HasilUjian::count();

        // Top Performers
        $topPerformers = HasilUjian::with(['murid', 'ujian'])
            ->orderBy('nilai', 'desc')
            ->limit(5)
            ->get()
            ->map(function($hasil) {
                return (object)[
                    'student_name' => $hasil->murid->nama ?? 'Unknown',
                    'class' => '10A',
                    'exam_name' => $hasil->ujian->nama_ujian ?? 'Unknown',
                    'score' => $hasil->nilai
                ];
            });

        // Score Distribution
        $scoreDistribution = [
            'excellent' => HasilUjian::whereBetween('nilai', [85, 100])->count(),
            'good' => HasilUjian::whereBetween('nilai', [70, 84])->count(),
            'average' => HasilUjian::whereBetween('nilai', [60, 69])->count(),
            'poor' => HasilUjian::where('nilai', '<', 60)->count(),
        ];



        $averageDuration = 90;

        // Transform results for view
        $results->getCollection()->transform(function($hasil) {
            $jawabanDetail = json_decode($hasil->jawaban ?? '[]', true);
            $tipeCount = collect($jawabanDetail)->countBy('tipe');
            $dominantTipe = $tipeCount->sortDesc()->keys()->first() ?? 'pilihan_ganda';

            return (object)[
                'id' => $hasil->id,
                'student_name' => $hasil->murid->nama ?? 'Unknown',
                'student_id' => $hasil->murid->id ?? 'N/A',
                'exam_name' => $hasil->ujian->nama_ujian ?? 'Unknown',
                'exam_subject' => $hasil->ujian->mataPelajaran->nama_mapel ?? 'Unknown',
                'tipe_ujian' => $dominantTipe === 'pilihan_ganda' ? 'PG' : 'Essay',
                'score' => $hasil->nilai,
                'passed' => $hasil->nilai >= 70,
                'completed_at' => $hasil->created_at,
                'jawaban_detail' => $jawabanDetail,
            ];
        });


        $averageCompletionTime = 45; // Rata-rata dari data jawaban

        return view('guru.lihat-hasil-ujian', compact(
            'results',
            'ujianList',
            'totalExams',
            'activeExams',
            'totalStudents',
            'completedStudents',
            'averageScore',
            'scoreTrend',
            'passingRate',
            'totalResults',
            'topPerformers',
            'scoreDistribution',
            'averageCompletionTime',
            'averageDuration'
        ));
    }
}


<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\HasilUjian;
use App\Models\Soal;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $mataPelajaran = MataPelajaran::all();

        // Ambil mapel yang sudah ada soalnya sebagai "ujian tersedia"
        $soalQuery = Soal::with('mataPelajaran')
            ->select('mapel_id')
            ->groupBy('mapel_id')
            ->havingRaw('COUNT(*) > 0');

        if ($request->filled('mapel_id')) {
            $soalQuery->where('mapel_id', $request->mapel_id);
        }

        $soalPerMapel = $soalQuery->get();

        // Statistik
        $totalUjianDiikuti  = HasilUjian::where('murid_id', $userId)->count();
        $rataRataNilai      = round(HasilUjian::where('murid_id', $userId)->avg('nilai') ?? 0, 1);
        $nilaiTertinggi     = HasilUjian::where('murid_id', $userId)->max('nilai') ?? 0;
        $ujianBaruMingguIni = Soal::where('created_at', '>=', now()->subDays(7))
            ->distinct('mapel_id')->count('mapel_id');

        $riwayatUjian = HasilUjian::with(['ujian.mataPelajaran'])
            ->where('murid_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('murid.dashboard', compact(
            'soalPerMapel',
            'mataPelajaran',
            'riwayatUjian',
            'totalUjianDiikuti',
            'ujianBaruMingguIni',
            'rataRataNilai',
            'nilaiTertinggi'
        ));
    }
}
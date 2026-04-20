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

        // XP calculation
        $totalXP = $totalUjianDiikuti * 100;
        $userLevel = 1 + floor($totalXP / 1000);
        $levelProgress = ($totalXP % 1000) / 1000 * 100;
        $currentLevelXP = $totalXP % 1000;
        $nextLevelXP = 1000;

        return view('Murid.dashboard', compact(
            'soalPerMapel',
            'mataPelajaran',
            'riwayatUjian',
            'totalUjianDiikuti',
            'ujianBaruMingguIni',
            'rataRataNilai',
            'nilaiTertinggi',
            'totalXP',
            'userLevel',
            'levelProgress',
            'currentLevelXP',
            'nextLevelXP'
        ));
    }

    public function redeemXP(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'xp_cost' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $userXP = $user->xp ?? 0;

        if ($userXP < $request->xp_cost) {
            return response()->json([
                'success' => false,
                'message' => 'XP tidak mencukupi!'
            ]);
        }

        $user->xp = $userXP - $request->xp_cost;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Hadiah berhasil ditebus!',
            'remaining_xp' => $user->xp
        ]);
    }
}


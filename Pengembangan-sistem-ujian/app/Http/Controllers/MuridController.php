<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\MataPelajaran;
use App\Models\HasilUjian;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MuridController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        
        // Get mata pelajaran untuk filter
        $mataPelajaran = MataPelajaran::all();
        
        // Get ujian tersedia
        $ujianQuery = Ujian::with(['mataPelajaran']);
        
        // Filter by mata pelajaran
        if ($request->has('mapel_id') && $request->mapel_id != '') {
            $ujianQuery->where('mapel_id', $request->mapel_id);
        }
        
        $ujian = $ujianQuery->paginate(6);
        
        // Get riwayat ujian terakhir
        $riwayatUjian = HasilUjian::with(['ujian.mataPelajaran'])
            ->where('murid_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Statistik
        $totalUjianDiikuti = HasilUjian::where('murid_id', $userId)->count();
        $ujianBaruMingguIni = Ujian::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $rataRataNilai = HasilUjian::where('murid_id', $userId)->avg('nilai') ?? 0;
        $nilaiTertinggi = HasilUjian::where('murid_id', $userId)->max('nilai') ?? 0;
        
        return view('murid.dashboard', compact(
            'ujian',
            'mataPelajaran',
            'riwayatUjian',
            'totalUjianDiikuti',
            'ujianBaruMingguIni',
            'rataRataNilai',
            'nilaiTertinggi'
        ));
    }
}
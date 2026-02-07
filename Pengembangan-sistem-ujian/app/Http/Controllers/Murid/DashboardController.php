<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\MataPelajaran;
use App\Models\HasilUjian;
use App\Models\Soal;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        
        // Get mata pelajaran untuk filter
        $mataPelajaran = MataPelajaran::all();
        
        // Get ujian tersedia (ujian yang belum dikerjakan oleh murid ini)
        $ujianQuery = Ujian::with(['mataPelajaran'])
            ->whereNotIn('id', function($query) use ($userId) {
                $query->select('ujian_id')
                    ->from('hasil_ujian')
                    ->where('murid_id', $userId);
            });
        
        // Filter by mata pelajaran
        if ($request->has('mapel_id') && $request->mapel_id != '') {
            $ujianQuery->where('mapel_id', $request->mapel_id);
        }
        
        $ujian = $ujianQuery->paginate(6);
        
        // Get riwayat ujian terakhir (max 5)
        $riwayatUjian = HasilUjian::with(['ujian.mataPelajaran'])
            ->where('murid_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Hitung statistik
        $totalUjianDiikuti = HasilUjian::where('murid_id', $userId)->count();
        
        $ujianBaruMingguIni = Ujian::where('created_at', '>=', Carbon::now()->subDays(7))
            ->whereNotIn('id', function($query) use ($userId) {
                $query->select('ujian_id')
                    ->from('hasil_ujian')
                    ->where('murid_id', $userId);
            })
            ->count();
        
        $rataRataNilai = HasilUjian::where('murid_id', $userId)->avg('nilai');
        $rataRataNilai = $rataRataNilai ? round($rataRataNilai, 1) : 0;
        
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
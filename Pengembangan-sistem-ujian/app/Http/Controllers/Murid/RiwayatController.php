<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilUjian;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        
        // Get mata pelajaran untuk filter
        $mataPelajaran = MataPelajaran::all();
        
        // Query riwayat ujian
        $riwayatQuery = HasilUjian::with(['ujian.mataPelajaran'])
            ->where('murid_id', $userId);
        
        // Filter by mata pelajaran
        if ($request->has('mapel_id') && $request->mapel_id != '') {
            $riwayatQuery->whereHas('ujian', function($query) use ($request) {
                $query->where('mapel_id', $request->mapel_id);
            });
        }
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $riwayatQuery->whereHas('ujian', function($query) use ($request) {
                $query->where('nama_ujian', 'like', '%' . $request->search . '%');
            });
        }
        
        $riwayatUjian = $riwayatQuery->orderBy('created_at', 'desc')->paginate(6);
        
        // Hitung statistik
        $totalUjian = HasilUjian::where('murid_id', $userId)->count();
        $rataRataNilai = HasilUjian::where('murid_id', $userId)->avg('nilai');
        $rataRataNilai = $rataRataNilai ? round($rataRataNilai, 1) : 0;
        $nilaiTertinggi = HasilUjian::where('murid_id', $userId)->max('nilai') ?? 0;
        $nilaiTerendah = HasilUjian::where('murid_id', $userId)->min('nilai') ?? 0;
        
        return view('murid.riwayat', compact(
            'riwayatUjian',
            'mataPelajaran',
            'totalUjian',
            'rataRataNilai',
            'nilaiTertinggi',
            'nilaiTerendah'
        ));
    }
}

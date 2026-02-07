<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuridController extends Controller
{
    public function index()
    {
        // Data dummy untuk dashboard
        $ujian = collect(); // Empty collection
        $totalUjianDiikuti = 0;
        $rataRataNilai = 0;
        $ujianBaruMingguIni = 0;
        $nilaiTertinggi = 0;
        $riwayatUjian = collect();
        $mataPelajaran = collect();
        
        return view('murid.dashboard', compact(
            'ujian',
            'totalUjianDiikuti', 
            'rataRataNilai',
            'ujianBaruMingguIni',
            'nilaiTertinggi',
            'riwayatUjian',
            'mataPelajaran'
        ));
    }
}
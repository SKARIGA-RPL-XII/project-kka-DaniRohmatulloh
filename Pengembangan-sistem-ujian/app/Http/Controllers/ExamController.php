<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ujian;

class MonitoringController extends Controller
{
    /**
     * Halaman utama monitoring (daftar ujian)
     */
    public function index()
    {
        $ujians = Ujian::with('mataPelajaran')->get();
        return view('examp', compact('ujians'));
    }
    
    /**
     * Tampilkan monitoring untuk ujian tertentu
     */
    public function show($id)
    {
        $ujian = Ujian::with('mataPelajaran')->findOrFail($id);
        
        // Ambil data statistik
        $stats = $this->getExamStatistics($id);
        
        return view('examp', compact('ujian', 'stats'));
    }
    
    private function getExamStatistics($ujianId)
    {
        // Data dummy untuk demo
        return [
            'total_students' => 8,
            'active_students' => 5,
            'submitted_students' => 2,
            'not_started_students' => 1,
            'average_score' => 75,
        ];
    }
}
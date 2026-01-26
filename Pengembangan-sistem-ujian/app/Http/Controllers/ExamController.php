<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return view('exam', [
            'waktu' => 600, // waktu ujian 10 menit (detik)
            'poin'  => 10   // poin per soal
        ]);
    }

    public function submit(Request $request)
    {
        $skor = 0;

        if ($request->jawaban === 'benar') {
            $skor += 10;
        }

        return redirect('/ujian')->with('skor', $skor);
    }
}

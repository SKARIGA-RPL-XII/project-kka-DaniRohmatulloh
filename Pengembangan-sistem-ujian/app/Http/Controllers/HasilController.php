<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilController extends Controller
{
    public function index()
    {
        return view('Murid.Riwayat');
    }

    public function show($ujian_id)
    {
        return view('murid.hasil.show', compact('ujian_id'));
    }

    public function detail($id)
    {
        $hasil = \App\Models\HasilUjian::with(['murid', 'ujian.mataPelajaran'])->findOrFail($id);
        return view('murid.hasil.detail', compact('hasil'));
    }
}
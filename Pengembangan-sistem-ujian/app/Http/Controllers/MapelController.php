<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function store(Request $request)
    {
        // Force non-JSON response
        $request->headers->set('Accept', 'text/html');
        
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100|unique:mata_pelajaran,nama_mapel',
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajaran,kode_mapel',
            'deskripsi' => 'nullable|string',
        ]);

        $mapel = MataPelajaran::create($validated);

        return redirect()->route('guru.soal.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan!')
            ->withInput();
    }
}

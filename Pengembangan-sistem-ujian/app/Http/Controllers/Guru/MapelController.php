<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:100|unique:mata_pelajaran,nama_mapel',
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajaran,kode_mapel'
        ]);

        $mapel = MataPelajaran::create($request->all());

        return redirect()->route('guru.soal.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }
}

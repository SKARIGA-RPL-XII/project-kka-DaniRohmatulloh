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
            'nama_mapel' => 'required|string|max:100|unique:mata_pelajaran,nama_mapel'
        ]);

        $mapel = MataPelajaran::create([
            'nama_mapel' => $request->nama_mapel
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mata pelajaran berhasil ditambahkan',
            'mapel' => $mapel
        ]);
    }
}
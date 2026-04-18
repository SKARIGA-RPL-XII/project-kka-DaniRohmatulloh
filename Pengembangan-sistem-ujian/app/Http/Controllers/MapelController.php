<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100|unique:mata_pelajaran,nama_mapel',
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajaran,kode_mapel',
            'deskripsi' => 'nullable|string',
        ]);

        $mapel = MataPelajaran::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Mata pelajaran berhasil ditambahkan',
                'mapel' => $mapel
            ]);
        }

        return redirect()->back()
            ->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }
}
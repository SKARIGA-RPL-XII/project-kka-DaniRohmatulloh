<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MataPelajaranController extends Controller
{

    public function index()
    {
        $mataPelajaran = MataPelajaran::orderBy('nama_mapel')->get();
        return response()->json($mataPelajaran);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255|unique:mata_pelajaran,nama_mapel',
            'kode_mapel' => 'required|string|max:50|unique:mata_pelajaran,kode_mapel',
        ]);

        try {
            $mapel = MataPelajaran::create([
                'nama_mapel' => $request->nama_mapel,
                'kode_mapel' => strtoupper($request->kode_mapel),
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'data' => $mapel]);
            }

            return redirect()->route('guru.soal.index')->with('success', 'Mata pelajaran berhasil ditambahkan!');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal menambahkan mata pelajaran'], 500);
            }
            return redirect()->route('guru.soal.index')->with('error', 'Gagal menambahkan mata pelajaran: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255|unique:mata_pelajaran,nama_mapel,' . $id,
            'kode_mapel' => 'required|string|max:50|unique:mata_pelajaran,kode_mapel,' . $id,
        ]);

        try {
            $mapel = MataPelajaran::findOrFail($id);
            $mapel->update([
                'nama_mapel' => $request->nama_mapel,
                'kode_mapel' => strtoupper($request->kode_mapel),
            ]);

            return redirect()->route('guru.soal.index')->with('success', 'Mata pelajaran berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->route('guru.soal.index')->with('error', 'Gagal mengupdate mata pelajaran: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $mapel = MataPelajaran::findOrFail($id);
            $namaMapel = $mapel->nama_mapel;
            
            $mapel->soal()->delete();
            $mapel->delete();
            
            DB::commit();
            
            return redirect()->route('guru.soal.index')->with('success', "Mata pelajaran '{$namaMapel}' beserta semua soalnya berhasil dihapus!");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('guru.soal.index')->with('error', 'Gagal menghapus mata pelajaran: ' . $e->getMessage());
        }
    }
}




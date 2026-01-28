<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SoalController extends Controller
{
    // Get all subjects
    public function getSubjects()
    {
        try {
            $subjects = DB::table('mata_pelajaran')
                ->select('id', 'nama_mapel')
                ->orderBy('nama_mapel', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Data mata pelajaran berhasil diambil',
                'data' => $subjects
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data mata pelajaran: ' . $e->getMessage()
            ], 500);
        }
    }

    // Add new subject
    public function addSubject(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'nama_mapel' => 'required|string|max:100|unique:mata_pelajaran,nama_mapel'
            ], [
                'nama_mapel.required' => 'Nama mata pelajaran wajib diisi',
                'nama_mapel.unique' => 'Mata pelajaran ini sudah ada'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Insert ke database
            $subjectId = DB::table('mata_pelajaran')->insertGetId([
                'nama_mapel' => $request->nama_mapel,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Ambil data yang baru saja dimasukkan
            $newSubject = DB::table('mata_pelajaran')
                ->where('id', $subjectId)
                ->first();

            return response()->json([
                'success' => true,
                'message' => 'Mata pelajaran berhasil ditambahkan',
                'data' => $newSubject
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get all questions
    public function index()
    {
        try {
            $soal = DB::table('soal')
                ->join('mata_pelajaran', 'soal.mapel_id', '=', 'mata_pelajaran.id')
                ->select(
                    'soal.*',
                    'mata_pelajaran.nama_mapel as subject_name'
                )
                ->orderBy('soal.created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Data soal berhasil diambil',
                'data' => $soal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data soal: ' . $e->getMessage()
            ], 500);
        }
    }

    // Store single question
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mapel_id' => 'required|integer|exists:mata_pelajaran,id',
                'pertanyaan' => 'required|string',
                'opsi_a' => 'required|string',
                'opsi_b' => 'required|string',
                'opsi_c' => 'nullable|string',
                'opsi_d' => 'nullable|string',
                'jawaban_benar' => 'required|in:A,B,C,D'
            ], [
                'mapel_id.required' => 'Mata pelajaran wajib dipilih',
                'mapel_id.exists' => 'Mata pelajaran tidak valid',
                'pertanyaan.required' => 'Pertanyaan wajib diisi',
                'opsi_a.required' => 'Opsi A wajib diisi',
                'opsi_b.required' => 'Opsi B wajib diisi',
                'jawaban_benar.required' => 'Jawaban benar wajib dipilih',
                'jawaban_benar.in' => 'Jawaban benar harus A, B, C, atau D'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $soalId = DB::table('soal')->insertGetId([
                'mapel_id' => $request->mapel_id,
                'pertanyaan' => $request->pertanyaan,
                'opsi_a' => $request->opsi_a,
                'opsi_b' => $request->opsi_b,
                'opsi_c' => $request->opsi_c,
                'opsi_d' => $request->opsi_d,
                'jawaban_benar' => $request->jawaban_benar,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $soal = DB::table('soal')
                ->join('mata_pelajaran', 'soal.mapel_id', '=', 'mata_pelajaran.id')
                ->select('soal.*', 'mata_pelajaran.nama_mapel as subject_name')
                ->where('soal.id', $soalId)
                ->first();

            return response()->json([
                'success' => true,
                'message' => 'Soal berhasil disimpan',
                'data' => $soal
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Store batch questions
    public function storeBatch(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mapel_id' => 'required|integer|exists:mata_pelajaran,id',
                'questions' => 'required|array|min:1',
                'questions.*.pertanyaan' => 'required|string',
                'questions.*.opsi_a' => 'required|string',
                'questions.*.opsi_b' => 'required|string',
                'questions.*.opsi_c' => 'nullable|string',
                'questions.*.opsi_d' => 'nullable|string',
                'questions.*.jawaban_benar' => 'required|in:A,B,C,D'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $savedQuestions = [];
            
            foreach ($request->questions as $questionData) {
                $soalId = DB::table('soal')->insertGetId([
                    'mapel_id' => $request->mapel_id,
                    'pertanyaan' => $questionData['pertanyaan'],
                    'opsi_a' => $questionData['opsi_a'],
                    'opsi_b' => $questionData['opsi_b'],
                    'opsi_c' => $questionData['opsi_c'] ?? null,
                    'opsi_d' => $questionData['opsi_d'] ?? null,
                    'jawaban_benar' => $questionData['jawaban_benar'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                $savedQuestions[] = $soalId;
            }

            return response()->json([
                'success' => true,
                'message' => count($savedQuestions) . ' soal berhasil disimpan',
                'data' => $savedQuestions
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Get question by ID
    public function show($id)
    {
        try {
            $soal = DB::table('soal')
                ->join('mata_pelajaran', 'soal.mapel_id', '=', 'mata_pelajaran.id')
                ->select('soal.*', 'mata_pelajaran.nama_mapel as subject_name')
                ->where('soal.id', $id)
                ->first();

            if (!$soal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Soal tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $soal
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete question
    public function destroy($id)
    {
        try {
            $soal = DB::table('soal')->where('id', $id)->first();

            if (!$soal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Soal tidak ditemukan'
                ], 404);
            }

            DB::table('soal')->where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Soal berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
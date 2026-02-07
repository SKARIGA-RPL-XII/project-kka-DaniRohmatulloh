<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Guru\SoalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\Murid\ProfilController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\Murid\DashboardController;
use App\Http\Controllers\Murid\RiwayatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/guru/examp', function () {
    try {
        // Coba ambil data dari database
        $mataPelajaran = DB::table('mata_pelajaran')
            ->orderBy('nama_mapel')
            ->get();
        $totalSoal = DB::table('soal')->count();
        $soals = DB::table('soal')
            ->leftJoin('mata_pelajaran', 'soal.mapel_id', '=', 'mata_pelajaran.id')
            ->select('soal.*', 'mata_pelajaran.nama_mapel')
            ->latest('soal.created_at')
            ->get();
    } catch (\Exception $e) {
        // Fallback ke data dummy jika database tidak tersedia
        $mataPelajaran = collect([
            (object)['id' => 1, 'nama_mapel' => 'Matematika'],
            (object)['id' => 2, 'nama_mapel' => 'Fisika'],
            (object)['id' => 3, 'nama_mapel' => 'Kimia'],
            (object)['id' => 4, 'nama_mapel' => 'Biologi']
        ]);
        $totalSoal = 0;
        $soals = collect();
    }
    
    return view('guru.Examp', compact('mataPelajaran', 'totalSoal', 'soals'));
})->name('guru.examp');

Route::get('/ujian', function () {
    return view('examp');
});

// AUTH ROUTES
require __DIR__.'/auth.php';

// Route untuk halaman web
Route::middleware(['auth'])->group(function () {
    // ROUTE UTAMA DASHBOARD - Redirect berdasarkan role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        if ($user->role === 'guru') {
            return redirect('/guru/dashboard');
        } elseif ($user->role === 'murid') {
            return redirect('/murid/dashboard');
        }
        
        return view('dashboard');
    })->name('dashboard');

    // Guru routes
Route::middleware(['auth'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/soal', [SoalController::class, 'create'])->name('soal.create');
    Route::post('/soal', [SoalController::class, 'store'])->name('soal.store');
    Route::delete('/soal/{soal}', [SoalController::class, 'destroy'])->name('soal.destroy');
    Route::post('/soal/{soal}/settings', [SoalController::class, 'updateSettings'])->name('soal.settings');
    
    Route::post('/mapel', [MapelController::class, 'store'])->name('mapel.store');
    Route::delete('/mapel/{id}', [SoalController::class, 'deleteSubject'])->name('mapel.destroy');
    
    Route::post('/ujian/kirim', [UjianController::class, 'kirim'])->name('ujian.kirim');
    
    // Dashboard
    Route::get('/dashboard', [GuruController::class, 'index'])->name('dashboard');
});
    
    Route::post('/guru/soal/generate', [SoalController::class, 'generate'])->name('guru.soal.generate');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Murid routes
Route::middleware(['auth'])->prefix('murid')->name('murid.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/ujian', [UjianController::class, 'index'])->name('ujian.index');
    Route::get('/ujian/{id}/mulai', [UjianController::class, 'mulai'])->name('ujian.mulai');
    Route::post('/ujian/{id}/submit', [UjianController::class, 'submit'])->name('ujian.submit');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::get('/hasil/{ujian_id}', [HasilController::class, 'show'])->name('hasil');
    Route::get('/hasil/detail/{id}', [HasilController::class, 'detail'])->name('hasil.detail');
    
    // Profil routes
    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [ProfilController::class, 'index'])->name('index');
        Route::put('/update', [ProfilController::class, 'update'])->name('update');
        Route::get('/ubah-password', [ProfilController::class, 'showUbahPassword'])->name('ubah-password');
        Route::post('/ubah-password', [ProfilController::class, 'updatePassword'])->name('update-password');
    });
});

 // Ujian routes
Route::middleware(['auth'])->prefix('ujian')->name('ujian.')->group(function () {
    Route::get('/', [UjianController::class, 'index'])->name('index');
    Route::get('/{id}/mulai', [UjianController::class, 'mulai'])->name('mulai');
    Route::get('/{id}/halaman', [UjianController::class, 'halamanUjian'])->name('halaman');
    Route::post('/{id}/submit', [UjianController::class, 'submit'])->name('submit');
});
    
 // Hasil routes
Route::middleware(['auth'])->prefix('hasil')->name('hasil.')->group(function () {
    Route::get('/', [HasilController::class, 'index'])->name('index');
    Route::get('/{ujian_id}', [HasilController::class, 'show'])->name('show');
    Route::get('/detail/{id}', [HasilController::class, 'detail'])->name('detail');
});

Route::middleware(['auth'])->group(function () {

    // Riwayat hasil ujian
    Route::get('/murid/hasil', [HasilController::class, 'index'])
        ->name('murid.hasil.index');

    // Hasil berdasarkan ujian
    Route::get('/murid/hasil/{ujian_id}', [HasilController::class, 'show'])
        ->name('murid.hasil.show');

    // Detail hasil / jawaban
    Route::get('/murid/hasil/detail/{id}', [HasilController::class, 'detail'])
        ->name('murid.hasil.detail');
});

// API Routes untuk Soal
Route::prefix('api')->group(function () {
    Route::get('/subjects', [SoalController::class, 'getSubjects']);
    Route::post('/subjects', [SoalController::class, 'addSubject']);
    Route::delete('/subjects/{id}', [SoalController::class, 'deleteSubject']);
    Route::get('/soal', [SoalController::class, 'index']);
    Route::post('/soal', [SoalController::class, 'store']);
    Route::post('/soal/batch', [SoalController::class, 'storeBatch']);
    Route::get('/soal/{id}', [SoalController::class, 'show']);
    Route::delete('/soal/{id}', [SoalController::class, 'destroy']);
});

 Route::prefix('soal')->name('soal.')->group(function () {
        Route::get('/', [SoalController::class, 'index'])->name('index');
        Route::get('/create', [SoalController::class, 'create'])->name('create');
        Route::post('/', [SoalController::class, 'store'])->name('store');
        Route::delete('/{soal}', [SoalController::class, 'destroy'])->name('destroy');
        
        // Buat soal otomatis
        Route::get('/create-auto', function () {
            return view('guru.soal.create-auto');
        })->name('create-auto');
    });
    
    // Mata Pelajaran
    Route::prefix('mapel')->name('mapel.')->group(function () {
        Route::post('/', [MapelController::class, 'store'])->name('store');
    });

    
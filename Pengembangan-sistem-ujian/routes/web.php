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

Route::get('/guru/examp', [GuruController::class, 'examp'])->name('guru.examp');

Route::get('/ujian', function () {
    return view('examp');
});

// AUTH ROUTES
require __DIR__.'/auth.php';

// Tambahan route GET logout untuk redirect ke form POST
Route::get('/logout', function () {
    return redirect()->route('login');
})->name('logout.get');

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
    Route::prefix('guru')->middleware(['auth'])->group(function () {
        Route::get('/soal', [SoalController::class, 'index'])->name('guru.soal.index');
        Route::post('/soal', [SoalController::class, 'store'])->name('guru.soal.store');
        Route::get('/soal/{id}/edit', [SoalController::class, 'edit'])->name('guru.soal.edit');
        Route::put('/soal/{id}', [SoalController::class, 'update'])->name('guru.soal.update');
        Route::delete('/soal/{id}', [SoalController::class, 'destroy'])->name('guru.soal.destroy');
        Route::post('/soal/generate', [SoalController::class, 'generate'])->name('guru.soal.generate');
        
        // Dashboard guru
        Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Murid routes
Route::middleware(['auth', 'role:murid'])->prefix('murid')->name('murid.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/ujian/{mapel_id}/mulai', [UjianController::class, 'mulai'])->name('ujian.mulai');
    Route::post('/ujian/{mapel_id}/submit', [UjianController::class, 'submit'])->name('ujian.submit');
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
    Route::get('/murid/hasil', [HasilController::class, 'index'])->name('murid.hasil.index');

    // Hasil berdasarkan ujian
    Route::get('/murid/hasil/{ujian_id}', [HasilController::class, 'show'])->name('murid.hasil.show');

    // Detail hasil / jawaban
    Route::get('/murid/hasil/detail/{id}', [HasilController::class, 'detail'])->name('murid.hasil.detail');
});

// API Routes untuk Soal
Route::prefix('api')->middleware(['auth'])->group(function () {
    Route::get('/subjects', [SoalController::class, 'getSubjects']);
    Route::post('/subjects', [SoalController::class, 'addSubject']);
    Route::delete('/subjects/{id}', [SoalController::class, 'deleteSubject']);
    Route::get('/soal', [SoalController::class, 'index']);
    Route::post('/soal', [SoalController::class, 'store']);
    Route::get('/soal/{id}', [SoalController::class, 'show']);
    Route::delete('/soal/{id}', [SoalController::class, 'destroy']);
});
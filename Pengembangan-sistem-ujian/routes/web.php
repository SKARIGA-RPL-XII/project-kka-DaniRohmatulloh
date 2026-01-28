<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MuridController;
use Illuminate\Http\Request;

// ========================================
// PUBLIC ROUTES (Tidak Perlu Login)
// ========================================

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/ujian', function () {
    return view('exam');
});
Route::post('/ujian/jawab', [ExamController::class, 'submit']);

// Jika ingin custom login/register view (opsional)
Route::get('/login-custom', function () {
    return view('auth.login');
})->name('login.custom');

Route::get('/register-custom', function () {
    return view('auth.register');
})->name('register.custom');

// API Routes untuk Soal
Route::prefix('api')->group(function () {
    // Mata Pelajaran
    Route::get('/subjects', [SoalController::class, 'getSubjects']);
    Route::post('/subjects', [SoalController::class, 'addSubject']);
    
    // Soal
    Route::get('/soal', [SoalController::class, 'index']);
    Route::post('/soal', [SoalController::class, 'store']);
    Route::post('/soal/batch', [SoalController::class, 'storeBatch']);
    Route::get('/soal/{id}', [SoalController::class, 'show']);
    Route::delete('/soal/{id}', [SoalController::class, 'destroy']);
});

// Route untuk halaman web
Route::middleware(['auth'])->group(function () {
    // ROUTE GURU - Simple routes
    Route::get('/guru/dashboard', function () {
        return view('guru.dashboard');
    });
    
    Route::get('/guru/soal', function () {
        return view('guru.soal');
    });
    
    // ROUTE MURID
    Route::get('/murid/dashboard', function () {
        return view('murid.dashboard');
    });
    
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

    // Profile routes (dari Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ROUTE MURID
    Route::prefix('murid')->name('murid.')->group(function () {
        Route::get('/dashboard', function () {
            if (Auth::user()->role !== 'murid') {
                return redirect('/dashboard')->with('error', 'Akses hanya untuk murid');
            }
            return view('murid.dashboard');
        })->name('dashboard');
    });

    // ROUTE UNTUK TESTING
    Route::get('/test-role', function () {
        $user = Auth::user();
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ],
            'role' => $user->role,
            'authenticated' => true
        ]);
    })->name('test.role');
});

// FALLBACK ROUTE
Route::fallback(function () {
    return view('exam');
});

// AUTH ROUTES
require __DIR__.'/auth.php';
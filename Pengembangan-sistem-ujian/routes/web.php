<?php
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
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

Route::get('/ujian', [ExamController::class, 'index']);
Route::post('/ujian/jawab', [ExamController::class, 'submit']);

// Jika ingin custom login/register view (opsional)
Route::get('/login-custom', function () {
    return view('auth.login');
})->name('login.custom');

Route::get('/register-custom', function () {
    return view('auth.register');
})->name('register.custom');

// ========================================
// AUTH ROUTES (Perlu Login)
// ========================================

Route::middleware(['auth'])->group(function () {
    
    // ROUTE UTAMA DASHBOARD - Redirect berdasarkan role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        if ($user->role === 'guru') {
            return view('guru.dashboard');
        } elseif ($user->role === 'murid') {
            return view('murid.dashboard');
        }
        
        // Default view jika role tidak dikenali
        return view('dashboard');
    })->name('dashboard');

    // ========================================
    // ROUTE GURU (dengan manual role check)
    // ========================================
    
    // Profile routes (dari Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard guru
    Route::get('/guru/dashboard', function () {
        if (Auth::user()->role !== 'guru') {
            return redirect('/dashboard')->with('error', 'Akses hanya untuk guru');
        }
        return view('guru.dashboard');
    })->name('guru.dashboard');
    
    // Soal guru
    Route::get('/guru/soal', function () {
        if (Auth::user()->role !== 'guru') {
            return redirect('/dashboard')->with('error', 'Akses hanya untuk guru');
        }
        return view('guru.soal');
    })->name('guru.soal');
    
    // Untuk controller-based routes guru (jika nanti dibuat)
    // Route::get('/guru/soal', [GuruController::class, 'index'])->name('guru.soal');
    // Route::get('/guru/ujian', [GuruController::class, 'ujian'])->name('guru.ujian');
    // Route::get('/guru/kelas', [GuruController::class, 'kelas'])->name('guru.kelas');

    // ========================================
    // ROUTE MURID (dengan manual role check)
    // ========================================
    Route::prefix('murid')->name('murid.')->group(function () {
        Route::get('/dashboard', function () {
            if (Auth::user()->role !== 'murid') {
                return redirect('/dashboard')->with('error', 'Akses hanya untuk murid');
            }
            return view('murid.dashboard');
        })->name('dashboard');
        
        // Untuk controller-based routes murid (jika nanti dibuat)
        // Route::get('/ujian', [MuridController::class, 'ujian'])->name('ujian');
        // Route::get('/ujian/{id}', [MuridController::class, 'showUjian'])->name('ujian.show');
        // Route::get('/hasil', [MuridController::class, 'hasil'])->name('hasil');
        // Route::get('/riwayat', [MuridController::class, 'riwayat'])->name('riwayat');
    });

    // ========================================
    // ROUTE PROFILE ALTERNATIVE (jika ingin versi sederhana)
    // ========================================
    Route::get('/profile-simple', function () {
        return view('profile.index', ['user' => Auth::user()]);
    })->name('profile.simple');

    // ========================================
    // ROUTE LOGOUT ALTERNATIVE (custom logout)
    // ========================================
    Route::post('/logout-custom', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout.custom');

    // ========================================
    // ROUTE UNTUK TESTING
    // ========================================
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

    // ========================================
    // ROUTE UNTUK DEBUGGING
    // ========================================
    Route::get('/debug/user', function () {
        $user = Auth::user();
        return view('debug.user', compact('user'));
    })->name('debug.user');
});

// ========================================
// ROUTE UNTUK GUEST (belum login)
// ========================================
Route::middleware(['guest'])->group(function () {
    Route::get('/guest-info', function () {
        return response()->json([
            'message' => 'Anda belum login',
            'authenticated' => false
        ]);
    })->name('guest.info');
});

// ========================================
// FALLBACK ROUTE (jika halaman tidak ditemukan)
// ========================================
Route::fallback(function () {
    return view('/examp');
});

// ========================================
// AUTH ROUTES (Laravel Breeze/Jetstream) - HARUS DI AKHIR
// ========================================
require __DIR__.'/auth.php';
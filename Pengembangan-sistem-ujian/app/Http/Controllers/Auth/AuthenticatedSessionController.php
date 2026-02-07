<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    $request->session()->regenerate();

    $user = Auth::user();
    
    // Debug: Log user role
    \Log::info('User logged in', ['email' => $user->email, 'role' => $user->role]);

    // Redirect berdasarkan role
    if ($user->role === 'guru') {
        return redirect()->intended('/guru/dashboard');
    }

    if ($user->role === 'murid') {
        return redirect()->intended('/murid/dashboard');
    }

    // Jika role tidak dikenali, logout dan redirect ke login
    Auth::logout();
    return redirect('/login')->withErrors([
        'role' => 'Role tidak dikenali: ' . $user->role,
    ]);
}
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

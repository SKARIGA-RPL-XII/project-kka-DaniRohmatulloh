<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (auth()->user()->role !== $role) {
            // Redirect ke dashboard sesuai role
            if (auth()->user()->role === 'guru') {
                return redirect()->route('guru.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            } else {
                return redirect()->route('murid.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
        }
        
        return $next($request);
    }
}
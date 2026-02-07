<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\HasilUjian;

class ProfilController extends Controller
{
    /**
     * Tampilkan halaman profil
     */
    public function index()
    {
        $user = Auth::user();
        
        // Hitung statistik untuk ditampilkan di sidebar profil
        $userId = $user->id;
        $totalUjianDiikuti = HasilUjian::where('murid_id', $userId)->count();
        $rataRataNilai = HasilUjian::where('murid_id', $userId)->avg('nilai');
        $rataRataNilai = $rataRataNilai ? round($rataRataNilai, 1) : 0;
        
        return view('murid.profil.index', compact(
            'user',
            'totalUjianDiikuti',
            'rataRataNilai'
        ));
    }
    
    /**
     * Update profil user
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('murid.profil.index')
                ->withErrors($validator)
                ->withInput();
        }
        
        // Update profil
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->save();
        
        return redirect()->route('murid.profil.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }
    
    /**
     * Tampilkan halaman ubah password
     */
    public function showUbahPassword()
    {
        return view('murid.profil.ubah-password');
    }
    
    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);
        
        $user = Auth::user();
        
        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect()->route('murid.profil.ubah-password')
                ->withInput()
                ->with('error', 'Password lama salah!');
        }
        
        // Update password baru
        $user->password = Hash::make($request->password_baru);
        $user->save();
        
        return redirect()->route('murid.profil.index')
            ->with('success', 'Password berhasil diubah!');
    }
}
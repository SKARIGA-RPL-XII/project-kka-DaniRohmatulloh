<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    public function index()
    {
        return view('murid.ujian.index');
    }

    public function mulai($id)
    {
        return view('murid.ujian.mulai', compact('id'));
    }

    public function halamanUjian($id)
    {
        return view('murid.ujian.halaman', compact('id'));
    }

    public function submit(Request $request, $id)
    {
        // Logic untuk submit ujian
        return redirect()->route('murid.hasil', $id);
    }
}
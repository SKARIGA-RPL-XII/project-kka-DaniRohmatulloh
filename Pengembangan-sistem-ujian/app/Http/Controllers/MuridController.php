<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MuridController extends Controller
{
    public function dashboard()
    {
        return view('murid.dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KursusSayaController extends Controller
{
    public function index()
    {
        return view('siswa.kursus.index');
    }
}

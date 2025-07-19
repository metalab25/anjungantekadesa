<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnjunganController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'Anjungan Mandiri Teka Desa',
        ]);
    }
}

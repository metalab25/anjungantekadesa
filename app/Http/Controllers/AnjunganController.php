<?php

namespace App\Http\Controllers;

class AnjunganController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'Anjungan Mandiri Teka Desa',
        ]);
    }
}

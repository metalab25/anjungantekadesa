<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $url = 'http://localhost:8001';
        
        $response = Http::withoutVerifying()->get($url . '/api/surat', [
            'search' => $search
        ]);
        $formatSurat = $response->json('data') ?? [];
        return view('surat.index', compact('formatSurat', 'search'));
    }
}

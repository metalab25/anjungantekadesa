<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AnjunganController extends Controller
{
    protected $apiBackend;

    public function __construct()
    {
        $this->apiBackend = env('DESA_BACKEND_API');
    }

    public function index()
    {
        $url = $this->apiBackend . '/api' . '/banner';
        $response = Http::get($url);
        $result = $response->json('data') ?? [];

        return view('index', [
            'title'     => 'Anjungan Mandiri Teka Desa',
            'banner'    => $result
        ]);
    }
}

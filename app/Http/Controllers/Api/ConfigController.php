<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ConfigController extends Controller
{
    public function getConfig(): View
    {

        $token = config('app.token');

        $url = env('DESA_API');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($url . '/api' . '/config');

        if ($response->successful()) {
            $data = $response->json();

            return view('config.index', [
                'title' => 'Anjungan Mandiri Teka Desa',
                'config' => $data['data'] ?? [],
            ]);
        }

        return view('config.index', [
            'title' => 'Anjungan Mandiri Teka Desa',
            'config' => [],
        ]);
    }
}

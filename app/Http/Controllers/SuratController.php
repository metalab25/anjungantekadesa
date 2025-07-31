<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuratController extends Controller
{
    protected $apiBase;

    public function __construct()
    {
        $this->apiBase = env('DESA_API');
    }

    protected function apiCookies()
    {
        $apiSession = session('api_session');
        return $apiSession ? ['laravel_session' => $apiSession] : [];
    }

    public function getAllSurat(Request $request)
    {
        $url = $this->apiBase . '/api' . '/surat';
        $response = Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))->get($url);
        $surat = $response->json('data') ?? [];
        return view('surat.index', compact('surat'));
    }

    public function createSurat($url_surat)
    {
        $url = $this->apiBase . '/api' . '/surat/' . $url_surat;
        $response = Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))->get($url);
        $formatSurat = $response->json('data') ?? null;

        if (!$formatSurat) {
            return redirect()->route('surat.index')->with('error', 'Format surat tidak ditemukan');
        }

        return view('surat.create', compact('formatSurat'));
    }

    public function storeSurat(Request $request, $url_surat)
    {
        $url = $this->apiBase . '/api' . '/surat/' . $url_surat . '/ajukan';
        $data = $request->except('_token');
        $response = Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))
            ->asForm()
            ->post($url, $data);

        $result = $response->json();
        if ($result['success'] ?? false) {
            return redirect()->route('surat.index')->with('success', 'Surat berhasil diajukan');
        }
        return back()->with('error', $result['message'] ?? 'Gagal mengajukan surat')->withInput();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SuratController extends Controller
{
    protected $apiBase = 'https://desa.beleka.begawe.com/api';

    protected function apiCookies()
    {
        $apiSession = session('api_session');
        return $apiSession ? ['laravel_session' => $apiSession] : [];
    }

    /**
     * Menampilkan semua format surat (list surat yang bisa diajukan)
     */
    public function getAllSurat(Request $request)
    {
        $url = $this->apiBase . '/surat';
        $response = Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))->get($url);
        $surat = $response->json('data') ?? [];
        return view('surat.index', compact('surat'));
    }

    /**
     * Menampilkan form pembuatan surat berdasarkan url_surat
     */
    public function createSurat($url_surat)
    {
        $url = $this->apiBase . '/surat/' . $url_surat;
        $response = Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))->get($url);
        $formatSurat = $response->json('data') ?? null;

        if (!$formatSurat) {
            return redirect()->route('surat.index')->with('error', 'Format surat tidak ditemukan');
        }

        return view('surat.create', compact('formatSurat'));
    }

    /**
     * Submit form surat ke API
     */
    public function storeSurat(Request $request, $url_surat)
    {
        $url = $this->apiBase . '/surat/' . $url_surat . '/ajukan';
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LayananMandiriController extends Controller
{
    protected $apiBase = 'http://localhost:8001/api/layanan-mandiri'; // Sesuaikan base path jika berbeda

    protected function apiCookies()
    {
        $apiSession = session('api_session');
        return $apiSession ? ['laravel_session' => $apiSession] : [];
    }

    public function login(Request $request)
    {
        $response = Http::post($this->apiBase . '/login', [
            'nik' => $request->nik,
            'pin' => $request->pin,
        ]);

        $result = $response->json();

        if ($result['success']) {
            session(['penduduk_session_id' => $result['data']['session_id']]);
            session(['penduduk_id' => $result['data']['penduduk_id']]);
            return redirect()->route('layanan.surat')->with('success', 'Login berhasil');
        }

        return back()->with('error', $result['message']);
    }

    public function logout()
    {
        $sessionId = session('penduduk_session_id');

        $response = Http::asForm()->post($this->apiBase . '/logout', [
            'session_id' => $sessionId,
        ]);

        session()->forget(['penduduk_session_id', 'penduduk_id']);
        return redirect()->route('layanan.login')->with('success', 'Berhasil logout');
    }

    public function listSurat()
    {
        $url = $this->apiBase . '/surat';
        $response = Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))->get($url);

        $surat = $response->json('data') ?? [];
        return view('surat.index', compact('surat'));
    }

    public function detailSurat($url_surat)
{
    $url = $this->apiBase . '/surat/' . $url_surat;
    $response = Http::get($url);
    $data = $response->json('data') ?? null;

    if (!$data) {
        return redirect()->route('surat.create')->with('error', 'Surat tidak ditemukan');
    }


    if (isset($data['kode_isian']) && is_string($data['kode_isian'])) {
        $data['kode_isian'] = json_decode($data['kode_isian'], true);
    }

    return view('surat.create', compact('data'));
}


    public function ajukanSurat(Request $request, $url_surat)
{
    $url = $this->apiBase . '/surat/' . $url_surat . '/ajukan';

    $response = Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))
        ->asJson()
        ->post($url, $request->except('_token')); 

        $result = $response->json();

        if (!$response->ok()) {
            return back()->with('error', 'Gagal menghubungi server API: ' . $response->status());
        }

        if (!is_array($result) || !isset($result['success'])) {
            return back()->with('error', 'Response tidak valid dari API');
        }

        if ($result['success']) {
            return redirect()->route('surat.index')->with('success', 'Surat berhasil diajukan');
        }

        return back()->with('error', $result['message'] ?? 'Gagal mengajukan surat');


    return back()->with('error', $result['message'] ?? 'Gagal mengajukan surat');
}


    public function arsipSurat()
    {
        $url = $this->apiBase . '/arsip';

        $response = Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))->get($url);
        $arsip = $response->json('data') ?? [];

        return view('surat.index', compact('arsip'));
    }

    public function downloadSurat($id)
    {
        $url = $this->apiBase . '/surat/' . $id . '/download';

        return Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))
            ->get($url)
            ->throw()
            ->body();
    }
}

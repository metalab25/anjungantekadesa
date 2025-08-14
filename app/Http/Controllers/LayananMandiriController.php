<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class LayananMandiriController extends Controller
{
    protected $apiBase;
    protected $showRfIdModal;

    public function __construct()
    {
        $this->apiBase = env('DESA_API');
        $user = Session::get('user');
        $this->showRfIdModal = $user['show_id_ktp'];

        view()->share('user', $user);
        view()->share('showRfIdModal', $this->showRfIdModal);
    }

    protected function apiCookies()
    {
        $apiSession = session('api_session');
        return $apiSession ? ['laravel_session' => $apiSession] : [];
    }

    public function login(Request $request)
    {
        $response = Http::post($this->apiBase . '/api' . '/layanan-mandiri' . '/login', [
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

        $response = Http::asForm()->post($this->apiBase . '/api' . '/layanan-mandiri' . '/logout', [
            'session_id' => $sessionId,
        ]);

        session()->forget(['penduduk_session_id', 'penduduk_id']);
        return redirect()->route('layanan.login')->with('success', 'Berhasil logout');
    }

    public function listSurat()
    {
        $url = $this->apiBase . '/api' . '/layanan-mandiri' . '/surat';
        $response = Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))->get($url);

        $surat = $response->json('data') ?? [];
        return view('surat.index', compact('surat'));
    }

    public function detailSurat($url_surat)
    {
        $url = $this->apiBase . '/api' . '/layanan-mandiri' . '/surat/' . $url_surat;
        $response = Http::get($url);
        $data = $response->json('data') ?? null;
        $user = Session::get('user');

        if (!$data) {
            return redirect()->back()->with('error', 'Surat tidak ditemukan');
        }

        if (isset($data['kode_isian']) && is_string($data['kode_isian'])) {
            $data['kode_isian'] = json_decode($data['kode_isian'], true);
        }

        return view('surat.create', compact('data', 'user'));
    }

    public function ajukanSurat(Request $request, $url_surat)
    {
        try {
            $url = $this->apiBase . '/api' . '/layanan-mandiri' . '/surat/' . $url_surat . '/ajukan';

            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])
                ->withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))
                ->asJson()
                ->post($url, $request->except('_token'));

            $result = $response->json();

            if ($result['status'] === 404) {
                Alert::error('Gagal Cetak Surat', $result['message']);
                return redirect()->back();
            }

            Alert::success('Berhasil', $result['message']);
            return redirect()->route('surat.arsip.surat');
        } catch (Exception $err) {
            Log::error('Gagal Mengajukan Surat: '  . $err->getMessage());
            return back()->with('Gagal Cetak Surat');
        }
    }

    public function arsipSurat()
    {
        $url = $this->apiBase . '/api' . '/layanan-mandiri' . '/arsip';

        $response = Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))->get($url);
        $arsip = $response->json('data') ?? [];

        return view('surat.index', compact('arsip'));
    }

    public function previewSurat(Request $request, $id)
    {
        $url = $this->apiBase . '/api' . '/layanan-mandiri/preview/surat/' . $id;

        $response = Http::get($url);
        $result = $response->json();

        if (!isset($result['status']) || $result['status'] !== 200) {
            abort(404, 'Surat tidak ditemukan');
        }

        if ($request->query('inline') == 'true') {
            return response(base64_decode($result['data']), 200, [
                'Content-Type' => $result['mime'],
                'Content-Disposition' => 'inline; filename="surat-preview.pdf"',
            ]);
        }

        return view('surat.preview', [
            'id' => $id,
            'data' => $result['data'],
            'mime' => $result['mime'],
        ]);
    }

    public function downloadSurat($id)
    {
        $url = $this->apiBase . '/api' . '/layanan-mandiri' . '/surat/' . $id . '/download';

        return Http::withCookies($this->apiCookies(), parse_url($url, PHP_URL_HOST))
            ->get($url)
            ->throw()
            ->body();
    }
}

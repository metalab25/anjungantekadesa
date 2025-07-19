<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $url = 'http://localhost:8001/api/layanan-mandiri/login';

        $response = Http::asForm()->post($url, [
            'nik' => $request->nik,
            'pin' => $request->pin,
        ]);

        $data = $response->json();

        if ($data['success'] ?? false) {
            $sessionCookie = $response->cookies()->getCookieByName('laravel_session');
            if ($sessionCookie) {
                session(['api_session' => $sessionCookie->getValue()]);
            }
            return redirect()->route('surat.index');
        } else {
            return back()->withErrors(['login' => $data['message'] ?? 'Login gagal'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        $url = 'http://localhost:8001/api/layanan-mandiri/logout';
        $apiSession = session('api_session');
        $cookies = [];
        if ($apiSession) {
            $cookies['laravel_session'] = $apiSession;
        }
        Http::withCookies($cookies, parse_url($url, PHP_URL_HOST))
            ->asForm()
            ->post($url, [
                'session_id' => $apiSession,
            ]);
        session()->forget('api_session');
        return redirect()->route('anjungan')->with('success', 'Logout berhasil');
    }
}

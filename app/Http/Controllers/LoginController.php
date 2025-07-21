<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function loginNik()
    {
        return view('index', [
            'title' => 'Login Teka Desa Anjungan Mandiri Dengan NIK'
        ]);
    }

    public function loginKtp()
    {
        return view('index', [
            'title' => 'Login Teka Desa Anjungan Mandiri Dengan Scan KTP'
        ]);
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'nik' => 'required|max:16',
            'pin' => 'required|max:6',
        ], [
            'required'  => ':attribute wajib diisi.',
            'max'    => ':attribute Maksimal :max Digit.',
        ]);

        Log::debug('Login attempt:', ['credentials' => $credentials]);

        $url = env('DESA_API');
        if (!$url) {
            Log::error('DESA_API environment variable is not set');
            return back()->withErrors([
                'pin' => 'Konfigurasi sistem tidak valid'
            ])->withInput();
        }

        try {
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post($url . '/anjungan/login', [
                    'nik' => $credentials['nik'],
                    'pin' => $credentials['pin'],
                ]);

            $responseData = $response->json();
            Log::debug('API Response:', [
                'status'    => $response->status(),
                'headers'   => $response->headers(),
                'body'      => $responseData ?? 'NULL_RESPONSE'
            ]);

            if ($response->successful() && isset($responseData['data'])) {
                $request->session()->put('user', $responseData['data']);
                return redirect()->route('surat.index');
            }

            $errorMsg = $responseData['message'] ?? 'PIN yang anda masukan salah.';
            return back()->withErrors([
                'pin' => $errorMsg,
            ])->withInput();
        } catch (\Exception $e) {
            Log::error('Login error:', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors([
                'pin' => 'Terjadi kesalahan koneksi: ' . $e->getMessage(),
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('anjungan');
    }
}

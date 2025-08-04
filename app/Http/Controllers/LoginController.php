<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

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
        try {
            $url = env('DESA_API');

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post($url . '/api' . '/anjungan/login', [
                    'nik' => $request->nik,
                    'pin' => $request->pin,
                ]);

            $responseData = $response->json();

            if ($responseData["status"] === 400) {
                $errors = $responseData['errors'];

                $errorMessages = collect($errors)
                    ->flatten()
                    ->implode('<br>');

                Alert::error($responseData['message'], $errorMessages);
            }

            if ($responseData["status"] === 404 || $responseData['status'] === 401) {
                Alert::error("Login Gagal", $responseData['message']);
            }

            $request->session()->put('user', $responseData['data']);
            return redirect()->route('surat.index');
        } catch (\Exception $e) {
            Log::error('Login error:', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back();
        }
    }

    public function auth_ktp(Request $request)
    {
        try {
            $url = env('DESA_API');

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post($url . '/api' . '/anjungan/login-ktp', [
                    'id_ktp' => $request->id_ktp,
                ]);

            $responseData = $response->json();

            if ($responseData["status"] === 400) {
                $errors = $responseData['errors'];

                $errorMessages = collect($errors)
                    ->flatten()
                    ->implode('<br>');

                Alert::error($responseData['message'], $errorMessages);
            }

            if ($responseData["status"] === 404 || $responseData['status'] === 401) {
                Alert::error("Login Gagal", $responseData['message']);
            }

            $request->session()->put('user', $responseData['data']);
            return redirect()->route('surat.index');
        } catch (\Exception $e) {
            Log::error('Login error:', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back();
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index()
    {
        return redirect('/');
    }

    public function store(Request $request)
    {

        $credentials = $request->validate([
            'nik' => ['required'],
            'pin' => ['required'],
        ]);


        try {
            $response = Http::withoutVerifying()->post('http://localhost:8001/api/anjungan/login', [
                'nik' => $credentials['nik'],
                'pin' => $credentials['pin'],
            ]);

            if ($response->successful() && isset($response['data'])) {
                $request->session()->put('user', $response['data']);
                return redirect()->route('surat.index');
            }

            $errorMsg = $response->json('message') ?? 'PIN atau password salah.';
            return back()->withErrors([
                'pin' => $errorMsg,
            ])->withInput();
        } catch (\Exception $e) {
            return back()->withErrors([
                'pin' => 'Terjadi kesalahan koneksi: ' . $e->getMessage(),
            ])->withInput();
        }
    }

    public function auth(Request $request){

    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('anjungan');
    }
}

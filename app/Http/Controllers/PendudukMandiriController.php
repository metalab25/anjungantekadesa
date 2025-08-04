<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PendudukMandiriController extends Controller
{
    protected $apiBase;
    protected $token;

    public function __construct()
    {
        $this->apiBase = env('DESA_API');
        $this->token = config('app.token');
    }

    public function updateIdKtp(Request $request, $penduduk_id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post($this->apiBase . '/api' . '/update-id-ktp' . '/' . $penduduk_id, [
            'id_ktp' => $request->id_ktp,
        ]);

        $result = $response->json();

        if ($result['status'] === 200) {
            $user = Session::get('user');

            $user['show_id_ktp'] = false;

            Session::put('user', $user);

            Alert::success('Berhasil', $result['message']);
        }

        if ($result['status'] === 400) {

            $errors = $result['errors'];

            $errorMessages = collect($errors)
                ->flatten()
                ->implode('<br>');

            Alert::error($result['message'], $errorMessages);
        }

        return back();
    }
}

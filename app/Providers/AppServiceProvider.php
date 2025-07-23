<?php

namespace App\Providers;

use App\Models\Config;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $token = config('app.token');
        $url = env('DESA_API');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->withoutVerifying()->get($url . '/config');

        if ($response->successful()) {
            $data = $response->json();

            $config = (object) $data['data'][0];
            $setting = (object) $data['data'][1];
            $pengumuman = (object) $data['data'][2];

            View::share('config', $config);
            View::share('setting', $setting);
            View::share('pengumuman', $pengumuman);
        } else {
            View::share('config', null);
            View::share('setting', null);
        }
    }
}

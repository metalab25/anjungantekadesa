<?php

namespace App\Providers;

use App\Models\Config;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        $zona_waktu = DB::table('settings')->value('zona_waktu');
        if ($zona_waktu) {
            config(['app.timezone' => $zona_waktu]);
            date_default_timezone_set($zona_waktu);
        }

        // Setting Data
        $setting = Setting::findOrFail(1);
        View::share('setting', $setting);

        // Desa Data
        $config = Config::findOrFail(1);
        View::share('config', $config);
    }
}

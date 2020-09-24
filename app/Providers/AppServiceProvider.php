<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share([
            'app' => [
                'name' => Config::get('app.name'),
                'locale' => Config::get('app.locale'),
            ],
            'language' => function () {

                $path = resource_path('lang/'. app()->getLocale() .'.json');

                if(!file_exists($path)) {
                    return [];
                }
                return json_decode(file_get_contents($path), true);
            },
            'flash' => function () {
                return [
                    'success' => Session::get('success'),
                    'error' => Session::get('error'),
                    'info' => Session::get('info'),
                ];
            },
        ]);
    }
}

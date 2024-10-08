<?php

namespace App\Providers;

use App\Services\OpenWeatherApiService;
use Illuminate\Support\ServiceProvider;

class OpenWeatherApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(OpenWeatherApiService::class, function () {
            return new OpenWeatherApiService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

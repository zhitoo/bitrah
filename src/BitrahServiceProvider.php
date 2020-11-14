<?php

namespace Hshafiei374\Bitrah;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class BitrahServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('bitrah', function ($app) {
            return new Bitrah();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'bitrah');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('bitrah.php'),
            ], 'config');
        }
    }
}

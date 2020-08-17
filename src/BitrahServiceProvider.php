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
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'bitrah');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bitrah');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'bitrah');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('bitrah', function($app) {
            return new Bitrah();
        });
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/bitrah'),
            ]);
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('bitrah.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/bitrah'),
            ], 'views');

            if (!class_exists('CreateBitrahTransactionsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_bitrah_transactions_table.php.stub' =>
                        database_path('migrations/' . date('Y_m_d_His', time()) . '_create_bitrah_transactions_table.php'),
                ], 'migrations');

            }
        }
        $this->registerRoutes();
    }
    protected function registerRoutes()
    {
        Route::group($this->webHookRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/hooks.php');
        });
        Route::group($this->callBackRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/callbacks.php');
        });

    }
    protected function webHookRouteConfiguration()
    {
        return [
            'prefix' => config('bitrah.default_webhook_url_route_prefix'),
            'middleware' => config('bitrah.default_webhook_url_route_middleware'),
        ];
    }
    protected function callBackRouteConfiguration()
    {
        return [
            'prefix' => config('bitrah.default_callback_url_route_prefix'),
            'middleware' => config('bitrah.default_callback_url_route_middleware'),
        ];
    }

}

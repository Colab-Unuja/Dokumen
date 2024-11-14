<?php

namespace App\Providers;

use App\Services\RedisService;
use Illuminate\Support\ServiceProvider;
use Predis\Command\RedisFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $this->app->singleton(RedisService::class, function ($app) {
            return new RedisService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

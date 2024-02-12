<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\PaymentGatewayInterface;
use App\Http\Services\HyperpayServices;
use App\Http\Services\FatoorahServices;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PaymentGatewayInterface::class,function($app){
            return new HyperpayServices();
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

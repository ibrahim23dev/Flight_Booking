<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
            // Create a new handler stack with SSL verification disabled
            // $stack = HandlerStack::create();
            // $stack->push(Middleware::mapRequest(function ($request) {
            //     return $request->withUri($request->getUri()->withScheme('https'));
            // }));
    
            // // Create a new Guzzle client with the custom handler stack
            // $this->app->bind('GuzzleHttp\Client', function ($app) use ($stack) {
            //     return new Client(['handler' => $stack]);
            // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}

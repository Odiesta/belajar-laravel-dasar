<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //

    }

    public function provides()
    {
        return [HelloService::class, Foo::class, Bar::class];
    }
}

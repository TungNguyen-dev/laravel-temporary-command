<?php

namespace TungNguyen\TemporaryCommand\App\Providers;

use Illuminate\Support\ServiceProvider;

class TemporaryCommandServiceProvider extends ServiceProvider
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
        $this->publishes([
            __DIR__.'/../../Stubs/' => $this->app->basePath().'/stubs/',
        ]);
    }
}

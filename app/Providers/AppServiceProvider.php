<?php

namespace Douyasi\Providers;

use Illuminate\Support\ServiceProvider;
use Douyasi\Extensions\DouyasiBlade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        DouyasiBlade::register();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

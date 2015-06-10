<?php

namespace Douyasi\Providers;

use Illuminate\Support\ServiceProvider;
use Douyasi\Extensions\DouyasiBlade as DouyasiBlade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*注册自定义blade标签规则*/
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

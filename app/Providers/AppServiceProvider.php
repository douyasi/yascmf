<?php namespace Douyasi\Providers;

use Illuminate\Support\ServiceProvider;
use Douyasi\Extensions\DouyasiBlade as DouyasiBlade;


class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
		/*注册自定义blade标签规则*/
		DouyasiBlade::register();
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		
		#Laravel 5 默认绑定认证注册与认证
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'Douyasi\Services\Registrar'
		);
		
	}

}

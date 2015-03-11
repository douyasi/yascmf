<?php namespace Douyasi\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Douyasi\Handlers\Events\UserEventHandler as UserEventHandler;
class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);
	}

	/**
	 * 注册事件订阅者
	 * 
	 * @return void
	 */
	public function register()
	{
		//其实也可放在boot函数里面
		$this->app['events']->subscribe('Douyasi\Handlers\Events\UserEventHandler');
	}


}

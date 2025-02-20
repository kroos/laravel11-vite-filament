<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use App\Extensions\Auth\EloquentUserProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	* Register any application services.
	*/
	public function register(): void
	{
		//
	}

	/**
	* Bootstrap any application services.
	*/
	public function boot(): void
	{
		Auth::provider('loginuserprovider', function (Application $app, array $config) {
			// Return an instance of Illuminate\Contracts\Auth\UserProvider...
			return new EloquentUserProvider($app['hash'], $config['model']);
		});
	}
}

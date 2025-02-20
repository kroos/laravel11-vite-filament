<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use App\Extensions\Auth\EloquentUserProvider;

// if using plain text password or any custom password
// use Illuminate\Contracts\Hashing\Hasher;
// use App\Extensions\Auth\PlainHasher;


class AppServiceProvider extends ServiceProvider
{
	/**
	* Register any application services.
	*/
	public function register(): void
	{
		// Replace Laravel's default hasher with PlainHasher
		// $this->app->singleton(Hasher::class, function () {
		// 	return new PlainHasher();
		// });

		// Also bind it to the Hash facade
		// $this->app->extend('hash', function ($service, $app) {
		// 	return new PlainHasher();
		// });
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

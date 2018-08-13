<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {

		/**
		 * Set dynamic configuration for third party services
		 */

		view()->composer( 'layouts.app', function ( $view ) {
			$translations = getAllTranslations();
			$view->with( [ 'translations' => $translations ] );
		} );

		view()->composer( '*', function ( $view ) {

//			$current_lang = currentLanguage();

			$view->with( [
//				'current_lang' => $current_lang,
			] );
		} );

		Cashier::useCurrency('eur', '€');

	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}

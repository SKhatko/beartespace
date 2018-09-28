<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Illuminate\Pagination\Paginator;
use Laravel\Horizon\Horizon;

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

		view()->composer( 'master', function ( $view ) {
			$translations = getAllTranslations();
			$view->with( [ 'translations' => $translations ] );
		} );

		view()->composer( '*', function ( $view ) {

//			$current_lang = currentLanguage();

			$view->with( [
//				'current_lang' => $current_lang,
			] );
		} );

		Cashier::useCurrency( 'eur', '€' );

		Paginator::defaultView( 'pagination::vue' );

		Paginator::defaultSimpleView( 'pagination::vue' );

		Horizon::auth( function ( $request ) {
			return auth()->user() && auth()->user()->isAdmin() ? true : abort( 404 );
		} );
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

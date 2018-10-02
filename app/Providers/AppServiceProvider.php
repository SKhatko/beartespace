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

		Paginator::defaultView( 'pagination::vue' );

		Paginator::defaultSimpleView( 'pagination::vue' );

		Horizon::auth( function ( $request ) {
			return auth()->user() && auth()->user()->isAdmin() ? true : abort( 404 );
		} );

		\Braintree_Configuration::environment(config('services.braintree.environment'));
		\Braintree_Configuration::merchantId(config('services.braintree.merchant_id'));
		\Braintree_Configuration::publicKey(config('services.braintree.public_key'));
		\Braintree_Configuration::privateKey(config('services.braintree.private_key'));

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

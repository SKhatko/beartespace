<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use App\Language;
use Illuminate\Support\Facades\Cookie;


class SetApplicationLanguage {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {

		if ( ! Cookie::get( 'locale' ) ) {

			$browserLanguage = substr( isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '', 0, 2 );

			$langExists = Language::whereCode( $browserLanguage )->whereActive( 1 )->first();

			if ( $langExists ) {

				Cookie::queue( Cookie::make( 'locale', $browserLanguage, 60 * 24 * 365 ) );

				session( [ 'locale' => $browserLanguage ] );
				App::setLocale( $browserLanguage );
			} else {
				// default
				Cookie::queue( Cookie::make( 'locale', 'en', 60 * 24 * 365 ) );

				session( [ 'locale' => 'en' ] );
				App::setLocale( 'en' );
			}

		} else {
			session( [ 'locale' => Cookie::get( 'locale' ) ] );
			App::setLocale( Cookie::get( 'locale' ) );
		}

		return $next( $request );
	}
}

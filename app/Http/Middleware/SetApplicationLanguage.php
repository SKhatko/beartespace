<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use App\Language;


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

		if ( ! session()->has( 'lang' ) ) {

			$browserLanguage = substr( isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '', 0, 2 ); //read browser language

			$langExists = Language::whereCode( $browserLanguage )->whereActive( 1 )->first();

			if ( $langExists ) {
				session( [ 'lang' => $browserLanguage ] );
			} else {
				session( [ 'lang' => Config::get( 'app.locale' ) ] );
			}
		}

		App::setLocale( session( 'lang' ) ? session( 'lang' ) : Config::get( 'app.locale' ) );

		return $next( $request );
	}
}

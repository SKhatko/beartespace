<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class SetCurrency {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {


		if ( ! Cookie::get( 'currency' ) ) {
			$currency = currency()->hasCurrency( geoip( request()->ip() )->currency )
			            && currency()->isActive( geoip( request()->ip() )->currency ) ? geoip( request()->ip() )->currency : currency()->config( 'default' );

			session(['currency' => $currency]);

			Cookie::queue( Cookie::make( 'currency', $currency, 60 * 24 * 365 ) );
		} else {
			session(['currency' => Cookie::get( 'currency' )]);
		}

//		if ( ! session()->has( 'currency' ) ) {
//			session( [ 'currency' => ( session( 'currency' ) ?? currency()->hasCurrency( geoip( request()->ip() )->currency ) && currency()->isActive( geoip( request()->ip() )->currency ) ? geoip( request()->ip() )->currency : currency()->config( 'default' ) ) ] );
//		}

		return $next( $request );
	}
}

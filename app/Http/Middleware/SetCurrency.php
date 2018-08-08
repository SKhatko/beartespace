<?php

namespace App\Http\Middleware;

use Closure;

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

		if(!session()->has('currency' )) {
			session( [ 'currency' => ( session( 'currency' ) ?? currency()->hasCurrency( geoip( request()->ip() )->currency ) && currency()->isActive( geoip( request()->ip() )->currency ) ? geoip( request()->ip() )->currency : currency()->config( 'default' ) ) ] );
		}

		return $next( $request );
	}
}

<?php

namespace App\Http\Middleware;

use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;

class EmptyShoppingCard {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {

		if ( Cart::count() > 0 ) {
			return $next( $request );
		} else {
			return redirect( route( 'cart' ) );
		}
	}
}

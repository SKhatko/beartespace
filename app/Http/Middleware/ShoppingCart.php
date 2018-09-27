<?php

namespace App\Http\Middleware;

use Closure;
use App\Artwork;
use Gloudemans\Shoppingcart\Facades\Cart;


class ShoppingCart {
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

			$cartArtworks = Cart::content()->pluck( 'qty', 'id' );

			$artworks = Artwork::whereIn( 'id', $cartArtworks->keys() )->get();

			foreach ( $artworks as $artwork ) {
				if ( $artwork->availableInStockWithQuantity( $cartArtworks[ $artwork->id ] ) !== 'available' ) {
					return redirect( route( 'cart' ) )->with( 'inline-warning', 'Not all items from your shopping cart are available. Remove them from your cart to continue' );
				}
			};

			return $next( $request );

		} else {
			return redirect( route( 'cart' ) );
		}
	}
}

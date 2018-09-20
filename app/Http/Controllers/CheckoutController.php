<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Address;
use App\Order;
use App\Artwork;

class CheckoutController extends Controller {

	public function index() {

		$address = auth()->user()->primaryAddress;

		$cartArtworks = Cart::content()->pluck( 'qty', 'id' );

		$artworks = Artwork::whereIn( 'id', $cartArtworks->keys() )->get();

		$totalPrice = 0;

		foreach ( $artworks as $artwork ) {
			// If available in stock needed amount
			if ( $artwork->availableInStockWithQuantity( $cartArtworks[ $artwork->id ] ) === 'available' ) {
				$totalPrice += $artwork->price * $cartArtworks[ $artwork->id ];
			}
		};

		$totalFormattedPrice = currency( $totalPrice );

		return view( 'checkout.index', compact( 'artworks', 'address', 'cartArtworks', 'totalPrice', 'totalFormattedPrice' ) );
	}

}

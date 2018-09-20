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

		$totalPrice = $artworks->sum('price');

		$totalFormattedPrice = currency( $totalPrice );

		return view( 'checkout.index', compact( 'artworks', 'address', 'cartArtworks', 'totalPrice', 'totalFormattedPrice' ) );
	}

}

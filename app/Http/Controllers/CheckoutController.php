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

		$cartArtworks = Cart::content()->pluck( 'id' );

		$artworks = Artwork::find( $cartArtworks );

		//		return $address;

//		return Cart::total();

//		return auth()->user()->orders;
//		                     ->create([
//
//		]);

		return view( 'checkout.index', compact( 'artworks', 'address' ) );
	}

}

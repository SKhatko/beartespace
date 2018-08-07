<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Artwork;

class CartController extends Controller {

	public function index() {

		$oldCart = session( 'cart' );

		$cart = new Cart( $oldCart );

		return view( 'checkout.shopping-cart', with( [
			'artworks'   => $cart->items,
			'totalPrice' => $cart->totalPrice
		] ) );
	}

	public function addToCart( Request $request, $id ) {

		$artwork = Artwork::findOrFail( $id );

		$oldCart = session( 'cart' );

		$cart = new Cart( $oldCart );

		$cart->add( $artwork, $artwork->id );

		session( [ 'cart' => $cart ] );

		return redirect()->route( 'shopping-cart' );
	}

	public function toggleToCart( Request $request, $id ) {

		$artwork = Artwork::find( $id );

		$oldCart = session( 'cart' );

		$cart = new Cart( $oldCart );

		$cart->toggle( $artwork, $artwork->id );

		session( [ 'cart' => $cart ] );

//		return back();
	}


	public function removeFromCart( Request $request, $id ) {

		$artwork = Artwork::find( $id );

		$oldCart = session( 'cart' );

		$cart = new Cart( $oldCart );

		$cart->remove( $artwork, $artwork->id );

		session( [ 'cart' => $cart ] );

		return redirect()->route( 'shopping-cart' );
	}
}

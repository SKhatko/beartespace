<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Artwork;

class CartController extends Controller {

	public $response;

	public function index() {

		$artwork = Artwork::find( 2 );

//		$this->toggleCart(2);

//		return Cart::content()->values();

		return view( 'checkout.shopping-cart' );
	}

	public function buyNow( Request $request, $id ) {

		$artwork = Artwork::findOrFail( $id );

		$cart = Cart::content();

		if ( $cart->contains( 'id', $artwork->id ) ) {
			$cart->map( function ( $item, $rowId ) use ( $artwork ) {
				if ( $artwork->id == $item->id ) {
//					$this->removeItem( $rowId );
					$this->response = redirect()->route( 'cart' );

				}
			} );
		} else {
			$this->addItem( $artwork );
		}

		return $this->response;
	}

	public function addItem( $artwork ) {
		Cart::add( $artwork->id, $artwork->title, 1, $artwork->price );

		$this->response = redirect()->route( 'cart' );
	}

	public function removeItem( $rowId ) {
		Cart::remove( $rowId );

		$this->response = redirect()->route( 'cart' );
	}

}

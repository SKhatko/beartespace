<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artwork;
use App\Cart;

class CartController extends Controller {
	public function toggleCart( Request $request, $id ) {

		$artwork = Artwork::find( $id );

		$oldCart = session( 'cart' );

		$cart = new Cart( $oldCart );

		$cart->toggle( $artwork, $artwork->id );

		session( [ 'cart' => $cart ] );

		if($oldCart) {

			if ( $oldCart->totalQuantity < session( 'cart' )->totalQuantity ) {
				return [
					'status'  => 'success',
					'message' => 'Artwork Added to Shopping Cart',
					'data'    => session( 'cart' )
				];
			} else {
				return [
					'status'  => 'success',
					'message' => 'Artwork Removed from Shopping Cart',
					'data'    => session( 'cart' )
				];
			}
		} else {
			return [
				'status'  => 'success',
				'message' => 'Artwork Added to Shopping Cart',
				'data'    => session( 'cart' )
			];
		}


	}
}

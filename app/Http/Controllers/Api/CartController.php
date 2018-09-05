<?php

namespace App\Http\Controllers\Api;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artwork;

class CartController extends Controller {

	public $response;

	public function toggleCart( Request $request, $id ) {

		$artwork = Artwork::find( $id );

		$cart = Cart::content();

		if ( $cart->contains( 'id', $artwork->id ) ) {
			$cart->map( function ( $item, $rowId ) use ( $artwork ) {
				if ( $artwork->id == $item->id ) {
					$this->removeItem( $rowId );
				}
			} );
		} else {
			$this->addItem( $artwork );
		}

		if ( auth()->user() ) {
			Cart::restore( auth()->user()->id );
		}

		return $this->response;
	}

	public function addItem( $artwork ) {
		Cart::add( $artwork->id, $artwork->title, 1, $artwork->price, [ 'image_url' => $artwork->image_url ] );

		$this->response = [
			'status'  => 'success',
			'message' => 'Artwork Added to Shopping Cart',
			'data'    => Cart::content()->values()
		];
	}

	public function removeItem( $rowId ) {
		Cart::remove( $rowId );

		$this->response = [
			'status'  => 'success',
			'message' => 'Artwork Removed from Shopping Cart',
			'data'    => Cart::content()->values()
		];
	}
}

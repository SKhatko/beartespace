<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Artwork;

class CartController extends Controller {

	public $response;

	public function buyNow( Request $request, $id ) {

		$artwork = Artwork::findOrFail( $id );

		$cart = Cart::content();

		if ( $cart->contains( 'id', $artwork->id ) ) {
			$cart->map( function ( $item, $rowId ) use ( $artwork ) {
				if ( $artwork->id == $item->id ) {
					$this->response = redirect()->route( 'cart' );
				}
			} );
		} else {
			Cart::add( $artwork->id, $artwork->title, 1, $artwork->price, [ 'image_url' => $artwork->image_url ] );

			$this->response = redirect()->route( 'cart' );

		}

		return $this->response;
	}

	public function addItem( Request $request, $id ) {
		$artwork = Artwork::findOrFail( $id );

		if ( ! Cart::content()->contains( 'id', $artwork->id ) ) {
			Cart::add( $artwork->id, $artwork->title, 1, $artwork->price, [ 'image_url' => $artwork->image_url ] );
		}

		return redirect()->back()->with( 'message', [
			'status'  => 'success',
			'message' => $artwork->title . ' added to shopping cart'
		] );
	}

	public function removeItem( Request $request, $id ) {
		$artwork = Artwork::findOrFail( $id );

		if ( Cart::content()->contains( 'id', $artwork->id ) ) {
			$item = Cart::content()->where( 'id', $artwork->id )->first();

			Cart::remove( $item->rowId );
		}

		return redirect()->back()->with( 'message', [
			'status'  => 'success',
			'message' => $artwork->title . ' removed from shopping cart'
		] );
	}

}

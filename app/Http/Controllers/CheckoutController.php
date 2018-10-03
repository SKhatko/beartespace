<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Address;
use App\Order;
use App\Artwork;

class CheckoutController extends Controller {

	public function braintree( Request $request ) {

		$request->validate([
			'nonce' => 'required',
		]);

		$nonce = $request->input( 'nonce' );

		$user = auth()->user();

		if ( $user->hasBraintreeId() ) {
			$user->updateCard( $nonce );
		} else {
			$user->createAsBraintreeCustomer( $nonce );
		}

		return redirect()->route('payment');
	}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\ClientToken;

class CartCheckoutController extends Controller {
	public function shipping() {

		$user = auth()->user();

		return view( 'cart.shipping', compact( 'user' ) );
	}

	public function setPrimaryShippingAddress( $id ) {

		$user = auth()->user();

		$address = $user->addresses()->where( 'addresses.id', $id )->firstOrFail();

		$user->primaryAddress()->associate( $address );

		$user->save();

		return redirect( route( 'cart.checkout' ) );
	}

	public function payment() {

		$user = auth()->user();

		if ( $user->hasBraintreeId() ) {
			$clientToken = ClientToken::generate( [ 'customerId' => $user->braintree_id ] );
		} else {
			// TODO move to .env
			$clientToken = 'sandbox_9qqqx29m_8zf5jpxstv3pkjwy';
		}

		return view( 'cart.payment', compact( 'clientToken' ) );
	}


	public function savePaymentMethod( Request $request ) {

		$request->validate( [
			'nonce' => 'required',
		] );

		$nonce = $request->input( 'nonce' );

		$user = auth()->user();

		if ( $user->hasBraintreeId() ) {
			$user->updateCard( $nonce );
		} else {
			$user->createAsBraintreeCustomer( $nonce );
		}

		return redirect()->route( 'cart.checkout' );
	}

	public function checkout() {

		$user = auth()->user();
		$address = $user->primaryAddress;
		$paymentMethod = $user->paymentMethod();
//		return $paymentMethod;
		return view( 'cart.checkout', compact( 'address', 'paymentMethod' ) );
	}

	public function checkoutPost(Request $request) {
		return $request->all();
	}
}

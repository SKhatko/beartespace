<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller {

	public function cart() {

//		return Cart::content();

		return view( 'checkout.shopping-cart' );
	}

	public function checkout() {
		return view( 'checkout.checkout' );
	}

	public function address() {
		return view('checkout.address');
	}
}

<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Address;
use App\Order;

class CheckoutController extends Controller {

	public function index() {
		return view( 'checkout.index' );
	}

}

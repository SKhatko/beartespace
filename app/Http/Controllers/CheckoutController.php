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

//		['errors', $arrErrors]


//		dd(session('status'));
		return view( 'checkout.index', compact( 'address' ) );
	}

}

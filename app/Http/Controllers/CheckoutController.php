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

		return view( 'checkout.index', compact( 'address' ) );
	}

	public function braintree(Request $request) {

//		return $request->all();

		// tokencc_bj_kpj6s3_sj2bmn_5g4kkb_d3vbn3_k22

		if($request->input('nonce')) {
			auth()->user()->updateCard($request->input('nonce'));
		}

		return auth()->user();
	}

}

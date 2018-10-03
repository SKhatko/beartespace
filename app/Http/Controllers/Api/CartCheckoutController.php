<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartCheckoutController extends Controller
{

	public function shipping() {

		$user = auth()->user();

		return view( 'cart.shipping', compact( 'user' ) );
	}

	public function setPrimaryShippingAddress($id) {

		$user = auth()->user();

		$address = $user->addresses()->where( 'addresses.id', $id )->firstOrFail();

		$user->primaryAddress()->associate($address);

		$user->save();

		return redirect(route('checkout'));
	}

	public function checkout() {

		$address = auth()->user()->primaryAddress;

		return view( 'checkout.index', compact( 'address' ) );
	}


}

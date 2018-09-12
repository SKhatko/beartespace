<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller {

	public function index() {
		$addresses = auth()->user()->addresses;

		return view( 'address.index', compact( 'addresses' ) );
	}

	public function setDeliveryAddress($id) {
//		return $id;

		session(['delivery-address' => $id]);

		return redirect(route('checkout'));
	}


	public function edit( $id ) {
		$address = auth()->user()->addresses()->where( 'addresses.id', $id )->firstOrFail();

		return view( 'address.edit', compact( 'address' ) );
	}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller {

	public function index() {

		$user = auth()->user();

		return view( 'address.index', compact( 'user' ) );
	}

	public function setPrimaryAddress($id) {

		$user = auth()->user();

		$address = $user->addresses()->where( 'addresses.id', $id )->firstOrFail();

		$user->primaryAddress()->associate($address);

		$user->save();

		return redirect(route('checkout'));
	}


	public function edit( $id ) {
		$address = auth()->user()->addresses()->where( 'addresses.id', $id )->firstOrFail();

		return view( 'address.edit', compact( 'address' ) );
	}

}

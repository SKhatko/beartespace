<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller {

	public function index() {
		$addresses = auth()->user()->addresses;

//		if($addresses->count()) {

//			return $addresses;
		return view( 'address.index', compact( 'addresses' ) );
//		} else {
//			return $this->create();
//		}
	}

	public function store( Request $request ) {

		return $request->all();

		auth()->user()->addresses()->create( $request->all() );

		return redirect( route( 'address' ) );

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		$address = auth()->user()->addresses()->where( 'addresses.id', $id )->firstOrFail();

		return view( 'address.edit', compact( 'address' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}
}

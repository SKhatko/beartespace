<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Address;

class AddressController extends Controller {
	public function store( Request $request ) {

		$this->validate( $request, [
			'country_id' => 'required|integer',
			'address'    => 'required',
			'city'       => 'required',
			'region'     => 'required',
			'postcode'   => 'required',
			'email'      => 'required',
			'phone'      => 'required'
		] );

		if ( $request->input( 'id' ) ) {
			$address = Address::findOrFail( $request->input( 'id' ) );

			$address->fill($request->all());
//			$request->only( [
//				'county_id',
//				'address',
//				'address_2',
//				'city',
//				'region',
//				'postcode',
//				'email',
//				'phone',
//			] ) );
			$address->save();

//			auth()->user()->addresses()->save( $address );
		} else {
			auth()->user()->addresses()->create( $request->all() );
		}

		return [ 'status' => 'success', 'message' => 'Address saved', 'data' => auth()->user()->addresses ];
	}
}

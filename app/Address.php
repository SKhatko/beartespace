<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	protected $appends = [ 'address_string' ];

	protected $fillable = [
		'id',
		'name',
		'country_id',
		'address',
		'address_2',
		'city',
		'region',
		'postcode',
		'email',
		'phone'
	];

	public function country() {
		return $this->belongsTo( Country::class );
	}

	public function user() {
		return $this->belongsTo( User::class, 'user_addresses' );
	}

	public function order() {
		return $this->belongsTo( Order::class );
	}

	public function getAddressStringAttribute() {
		$addressString = '';

		if ( $this->name ) {
			$addressString .= $this->name . ', ';
		}
		if ( $this->email ) {
			$addressString .= $this->email . ', ';
		}
		if ( $this->phone ) {
			$addressString .= $this->phone . ', ';
		}
		if ( $this->address ) {
			$addressString .= $this->address . ', ';
		}
		if ( $this->address_2 ) {
			$addressString .= $this->address_2 . ', ';
		}
		if ( $this->city ) {
			$addressString .= $this->city . ', ';
		}
		if ( $this->region ) {
			$addressString .= $this->region . ', ';
		}
		if ( $this->postcode ) {
			$addressString .= $this->postcode . ', ';
		}
		if ( $this->country_id ) {
			$country       = Country::findOrFail( $this->country_id );
			$addressString .= $country->country_name;
		}

		return $addressString;
	}
}

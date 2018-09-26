<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;

class Order extends Model {

	public $incrementing = true;

	protected $fillable = [ 'user_id', 'payment_id', 'address', 'content', 'amount', 'status' ];

	public function getCartAttribute( $value ) {
		return json_decode( $value );
	}

	public function user() {
		return $this->belongsTo( User::class );
	}

	public function address() {
		return $this->hasOne( Address::class );
	}

	public function sales() {
		return $this->hasMany( Sale::class );
	}

	public function payment() {
		return $this->belongsTo( Payment::class );
	}

	public function scopeConfirmed( $query ) {
		return $query->where( 'confirmed_at', '<', now() );
	}

	public function addressString() {
		$addressString = '';

		$address = json_decode( $this->attributes['address'] );

		if ( $address->name ) {
			$addressString .= $address->name . ', ';
		}
		if ( $address->email ) {
			$addressString .= $address->email . ', ';
		}
		if ( $address->phone ) {
			$addressString .= $address->phone . ', ';
		}
		if ( $address->address ) {
			$addressString .= $address->address . ', ';
		}
		if ( $address->address_2 ) {
			$addressString .= $address->address_2 . ', ';
		}
		if ( $address->city ) {
			$addressString .= $address->city . ', ';
		}
		if ( $address->region ) {
			$addressString .= $address->region . ', ';
		}
		if ( $address->postcode ) {
			$addressString .= $address->postcode . ', ';
		}
		if ( $address->country_id ) {
			$country       = Country::findOrFail( $address->country_id );
			$addressString .= $country->country_name;
		}

		return $addressString;
	}

	public function getContentAttribute( $value ) {
		return unserialize( $value );
	}
}

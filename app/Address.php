<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

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
		return $this->belongsTo(User::class);
	}

	public function order() {
		return $this->belongsTo( Order::class );
	}
}

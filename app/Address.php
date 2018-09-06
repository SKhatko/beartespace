<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	protected $fillable = [
		'id',
		'country_id',
		'address',
		'address_2',
		'city',
		'region',
		'postcode',
		'email',
		'phone'
	];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function order() {
		return $this->belongsTo( Order::class );
	}
}

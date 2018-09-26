<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {

	protected $fillable = ['order_id', 'user_id', 'artwork_id', 'qty', 'price', 'status'];

	public function order() {
		return $this->belongsTo( Order::class );
	}

	public function user() {
		return $this->belongsTo( User::class );
	}

	public function artwork() {
		return $this->belongsTo( Artwork::class );
	}
}

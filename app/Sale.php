<?php

namespace App;

use App\Events\SaleCreated;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model {

	protected $dispatchesEvents = [
		'created' => SaleCreated::class,
	];

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

	public function scopeStatus($query, $status = null) {
		return $query->whereStatus($status);
	}

	public function total() {
		return $this->attributes['price'] * $this->attributes['qty'];
	}
}

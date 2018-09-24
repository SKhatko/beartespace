<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Cart;
use Gloudemans\Shoppingcart\CartItem;

class ShoppingCart extends Model
{
	protected $table = 'shoppingcart';

	public function getContentAttribute($value) {
		return unserialize($value);
	}

//	public function user() {
//		return $this->belongsTo(User::class, 'identifier');
//	}
//
//	public function order() {
//		$this->belongsTo(Order::class, 'instance');
//	}

}

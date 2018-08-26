<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Add extends Model {

	protected $dates = [ 'rebill_at' ];

	protected $fillable = ['name', 'price', 'rebill_at'];

	public function user() {
		return $this->belongsTo(User::class, 'id', 'user_id');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Add extends Model {

	protected $fillable = ['name', 'price'];

	public function user() {
		return $this->belongsTo(User::class, 'id', 'user_id');
	}
}

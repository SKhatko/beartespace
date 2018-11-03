<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model {

	public $timestamps = false;


	protected $casts = [
		'json_value' => 'array',
	];

	protected $fillable = [
		'name',
		'json_value',
		'text_value'
	];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	public $timestamps = false;

	protected $casts = [
		'artists_of_the_week' => 'array',
		'artworks_of_the_week' => 'array',
	];

	protected $fillable = [
		'artists_of_the_week',
		'artworks_of_the_week'
	];
}

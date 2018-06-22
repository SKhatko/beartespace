<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $guarded = [];
    public $timestamps = false;


	public function getIsRtlAttribute($value)
	{
		return !!$value;
	}

	public function getActiveAttribute($value)
	{
		return !!$value;
	}
}

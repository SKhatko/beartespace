<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model {

	public function getMonthAttribute( $value ) {
		return currency($value, null, session('currency'));
	}

	public function getYearAttribute( $value ) {
		return currency($value, null, session('currency'));
	}
}

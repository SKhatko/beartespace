<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model {

	public function getMonthAttribute() {
		return currency($this->month_price, null, session('currency'));
	}

	public function getYearAttribute() {
		return currency($this->year_price, null, session('currency'));
	}

}

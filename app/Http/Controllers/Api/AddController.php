<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddController extends Controller {

	public function createUserAdd( $name, $price, $period = null ) {

		$user = auth()->user();

		if($period === 'week') {
			$period = Carbon::now()->addWeek();
		} elseif ($period === 'month') {
			$period = Carbon::now()->addMonth();
		} elseif ($period === 'year') {
			$period = Carbon::now()->addYear();
		} else {
			$period = null;
		}


		$user->adds()->create( [
			'name'      => $name,
			'price'     => $price,
			'rebill_at' => $period,
		] );

		$user->deductFromBalance( $price );

		return [
			'status'  => 'success',
			'message' => currency( $price ) . ' deducted from your balance',
			'data'    => $user,
		];
	}
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddController extends Controller {

	public function createUserAdd( $name, $price ) {

		$user = auth()->user();

		$user->adds()->create( [ 'name' => $name, 'price' => $price ] );

		$user->deductFromBalance($price);

		return [
			'status'  => 'success',
			'message' => currency( $price ) . ' deducted from your balance',
			'data'    => $user
		];
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller {
	public function switchCurrency( $code ) {

		$currencyExists = currency()->hasCurrency( $code );

		if ( $currencyExists ) {
			session( [ 'currency' => $code ] );
		}

		return back();

	}
}

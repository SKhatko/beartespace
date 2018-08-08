<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CurrencyController extends Controller {

	public function switchCurrency( $code ) {

		if ( currency()->hasCurrency( $code ) ) {

			Cookie::queue( Cookie::make( 'currency', $code, 60 * 24 * 365 ) );
//			session( [ 'currency' => $code ] );
		}

		return back();

	}
}

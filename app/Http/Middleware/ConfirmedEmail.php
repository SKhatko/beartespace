<?php

namespace App\Http\Middleware;

use Closure;

class ConfirmedEmail {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {

		if ( !$request->user()->email_verified ) {
			return redirect()->route('confirm-email.verify');
		}

		return $next( $request );
	}
}

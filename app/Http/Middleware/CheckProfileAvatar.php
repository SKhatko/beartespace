<?php

namespace App\Http\Middleware;

use Closure;

class CheckProfileAvatar {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		if ( ( auth()->user()->user_type === 'artist' || auth()->user()->user_type === 'gallery' ) && ! auth()->user()->avatar ) {
			$request->session()->flash( 'notify', [
				'title'   => 'Profile is not complected',
				'message' => 'Please upload <a href="' . route( 'dashboard.profile' ) . '"><b>avatar/logo</b></a>'
			] );
		}

		return $next( $request );
	}
}

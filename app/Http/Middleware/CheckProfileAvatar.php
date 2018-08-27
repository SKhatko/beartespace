<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

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
			if(!Cookie::get('check-profile-avatar')) {
				Cookie::queue( Cookie::make( 'check-profile-avatar', true, 1 ) );

				$request->session()->flash( 'notify', [
					'title'   => 'Profile is not completed',
					'message' => 'You already have access to basic profile. This information represents you for customers and makes you more attractive. Please fill in <a href="' . route( 'dashboard.profile' ) . '"><b>profile information</b></a>.'
				] );
			}

		}

		return $next( $request );
	}
}

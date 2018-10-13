<?php

namespace App\Http\Controllers;

use App\SocialAccountService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Laravel\Socialite\Facades\Socialite;

class SocialLogin extends Controller {

	public function redirectFacebook() {
		return Socialite::driver( 'facebook' )->redirect();
	}

	public function callbackFacebook( SocialAccountService $service ) {
		try {
			$fbUser = Socialite::driver( 'facebook' )->user();
			$user    = $service->createOrGetFBUser( $fbUser );
			if ( ! $user ) {
				return redirect( route( 'facebook-redirect' ) );
			}
			auth()->login( $user );

			return redirect()->intended( route( 'dashboard' ) );
		} catch ( \Exception $e ) {
			return redirect( route( 'login' ) )->with( 'inline-error', $e->getMessage() );
		}
	}


	public function redirectGoogle() {
		return Socialite::driver( 'google' )->redirect();
	}

	public function callbackGoogle( SocialAccountService $service ) {
		try {
			$googleUser = Socialite::driver( 'google' )->user();

			$user = $service->createOrGetGoogleUser( $googleUser );
			if ( ! $user ) {
				return redirect( route( 'google-redirect' ) );
			}
			auth()->login( $user );

			return redirect()->intended( route( 'dashboard' ) );
		} catch ( \Exception $e ) {
			//return $e->getMessage();
			logger($e->getMessage());
			return redirect( route( 'login' ) )->with( 'inline-error', $e->getMessage() );
		}
	}

	public function redirectTwitter() {
		return Socialite::driver( 'twitter' )->redirect();
	}

	public function callbackTwitter( SocialAccountService $service ) {
		try {
			$twitterUser = Socialite::driver( 'twitter' )->user();
			$user         = $service->createOrGetTwitterUser( $twitterUser );
			if ( ! $user ) {
				return redirect( route( 'twitter-redirect' ) );
			}
			auth()->login( $user );

			return redirect()->intended( route( 'dashboard' ) );
		} catch ( \Exception $e ) {
			//return $e->getMessage();
			return redirect( route( 'login' ) )->with( 'inline-errors', $e->getMessage() );
		}
	}

}

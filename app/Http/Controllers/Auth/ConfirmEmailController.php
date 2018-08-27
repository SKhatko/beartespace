<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\SignupActivate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class ConfirmEmailController extends Controller {
	public function changeEmail( Request $request ) {

		$request->validate( [
			'email'    => 'required|string|email|max:255|unique:users|confirmed',
			'password' => 'required|string|min:6',
		] );

		$user = auth()->user();
		if ( Hash::check( $request->input( 'password' ), $user->password ) ) {
			// Success
			$user->email          = $request->input( 'email' );
			$user->email_verified = false;
			$user->save();

			$this->resend();
		}

	}

	public function verify() {

		return view( 'auth.confirm' );
	}

	public function confirm( $token ) {

		$user = User::where( 'activation_token', $token )->first();

		if ( ! $user ) {
			return redirect( '/' );
		}

		$user->email_verified = true;

		$user->save();

		auth()->logout();

		if ( $user->user_type == 'artist' ) {
			return redirect()->route( 'dashboard.profile' );
		}

		return redirect()->route( 'dashboard' );
	}

	public function resend() {

		$user = auth()->user();

		$user->notify( new SignupActivate( $user ) );

		return redirect()->route( 'confirm-email.verify' );

	}
}

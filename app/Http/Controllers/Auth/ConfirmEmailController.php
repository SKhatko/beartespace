<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\SignupActivate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ConfirmEmailController extends Controller
{
	public function verify() {

		return view( 'auth.confirm');
	}

	public function confirm( $token ) {

		$user = User::where( 'activation_token', $token )->first();

		if ( ! $user ) {
			return redirect('/');
		}

		$user->email_verified = true;

		$user->save();

//		auth()->login($user);
		return redirect()->route('login');

		return redirect()->route('dashboard.profile')->with('alert', [
			'title'   => 'Email address confirmed',
			'message' => 'Please fill up profile information'
		]);
	}

	public function resend() {

		$user = auth()->user();

		$user->notify( new SignupActivate( $user ) );

		return redirect()->route('confirm-email.verify');

	}
}

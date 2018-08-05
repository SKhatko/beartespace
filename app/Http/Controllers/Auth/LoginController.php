<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;


	public function login( Request $request ) {

		$this->validateLogin($request);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if ($this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}

		if ($this->attemptLogin($request)) {
			return $this->sendLoginResponse($request);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);

		return $this->sendFailedLoginResponse($request);
//
//		$request->validate( [
//			$this->username() => 'required|string',
//			'password'        => 'required|string',
//		] );

//		$this->validate( $request, array( 'g-recaptcha-response' => 'required' ) );
//
//		$secret             = env( 'recaptcha_secret_key' );
//		$gRecaptchaResponse = $request->input( 'g-recaptcha-response' );
//		$remoteIp           = $request->ip();
//
//		$recaptcha = new \ReCaptcha\ReCaptcha( $secret );
//		$resp      = $recaptcha->verify( $gRecaptchaResponse, $remoteIp );
//		if ( ! $resp->isSuccess() ) {
//			return redirect()->back()->with( 'error', 'reCAPTCHA is not verified' );
//		}
//
//		$user = User::whereEmail( $request->email )->first();
//
//		// If the class is using the ThrottlesLogins trait, we can automatically throttle
//		// the login attempts for this application. We'll key this by the username and
//		// the IP address of the client making these requests into this application.
//		if ( $this->hasTooManyLoginAttempts( $request ) ) {
//			$this->fireLockoutEvent( $request );
//
//			return $this->sendLockoutResponse( $request );
//		}
//
//		if ( $user ) {
//
//			$request->session()->regenerate();
//
//			$this->clearLoginAttempts( $request );
//
//			if ( ! $this->getAccessToken( $request ) ) {
//				return $this->sendFailedLoginResponse( $request );
//			}
//
//			$this->guard()->login( $user );
//
//			return redirect()->route( 'home' )
//				?: redirect()->intended( $this->redirectPath() );
//		}
//
//		// If the login attempt was unsuccessful we will increment the number of attempts
//		// to login and redirect the user back to the login form. Of course, when this
//		// user surpasses their maximum number of attempts they will get locked out.
//		$this->incrementLoginAttempts( $request );
//
//		return $this->sendFailedLoginResponse( $request );
	}

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware( 'guest' )->except( 'logout' );
	}

}

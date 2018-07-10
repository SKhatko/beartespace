<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Jobs\SendVerificationEmail;


class RegisterController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function register( Request $request ) {

		$request->validate( [
			'first_name' => 'required|string|max:255',
			'last_name'  => 'required|string|max:255',
			'email'      => 'required|string|email|max:255|unique:users',
			'password'   => 'required|string|min:6',
			'user_type'  => 'required|string'
//			'g-recaptcha-response' => 'required|captcha'
		] );

		$user = User::create( [
			'first_name'       => $request->input( 'first_name' ),
			'last_name'        => $request->input( 'last_name' ),
			'email'            => $request->input( 'email' ),
			'password'         => bcrypt( $request->input( 'password' ) ),
			'user_type'        => $request->input( 'user_type' ),
			'activation_token' => str_random( 60 )
//			'g-recaptcha-response' => 'required|captcha'
		] );

		event( new Registered( $user ) );

		//		$user->notify(new SignupActivate($user));

		//		dispatch( new SendVerificationEmail( $user ) );

		$this->guard()->login( $user );

		return view( 'auth.confirm' );
	}

	public function verify() {

		$user = auth()->user();


		dispatch( new SendVerificationEmail( $user ) );

		return view( 'auth.confirm' );

	}

	public function registerActivate( $token ) {

		$user = User::where( 'activation_token', $token )->first();

		if ( ! $user ) {
			return response()->json( [
				'message' => 'This activation token is invalid.'
			], 404 );
		}

		$user->email_verified = true;
		$user->save();

		return $user;
	}

	public function confirm() {


	}

	/**
	 * Where to redirect users after registration.
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
		$this->middleware( 'guest' );
	}
}

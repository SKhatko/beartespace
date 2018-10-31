<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\SignupActivate;
use Gloudemans\Shoppingcart\Facades\Cart;


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
//			'user_type'  => 'required|string|in:user,artist,gallery',
		] );

		$user = User::create( [
			'first_name'       => $request->input( 'first_name' ),
			'last_name'        => $request->input( 'last_name' ),
			'email'            => $request->input( 'email' ),
			'password'         => bcrypt( $request->input( 'password' ) ),
			'user_type'        => 'user',
			'activation_token' => str_random( 60 )
		] );

		// Save shopping cart to db;
		Cart::instance('shoppingcart')->store($user->id);

		event( new Registered( $user ) );

		$this->guard()->login( $user );

		$user->notify( new SignupActivate( $user ) );

		return redirect($this->redirectTo);
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

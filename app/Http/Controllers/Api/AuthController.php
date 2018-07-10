<?php

namespace App\Http\Controllers\Api;

use App\Notifications\SignupActivate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller {
	/**
	 * Create user
	 *
	 * @param  [string] name
	 * @param  [string] email
	 * @param  [string] password
	 * @param  [string] password_confirmation
	 *
	 * @return [string] message
	 */
	public function register( Request $request ) {
		$user = new User( [
			'first_name' => $request->first_name,
			'last_name'  => $request->last_name,
			'user_type'  => $request->user_type,
			'email'      => $request->email,
			'password'   => bcrypt( $request->password )
		] );
		$user->save();

//		$user->notify(new SignupActivate($user));

		return response()->json( [
			'message' => 'Successfully created user!'
		], 201 );
	}


	/**
	 * Logout user (Revoke the token)
	 *
	 * @return [string] message
	 */
	public function logout( Request $request ) {
		$request->user()->token()->revoke();

		return response()->json( [
			'message' => 'Successfully logged out'
		] );
	}

	/**
	 * Get the authenticated User
	 *
	 * @return [json] user object
	 */
	public function user( Request $request ) {
		return response()->json( $request->user() );
	}

	public function registerActivate( $token ) {
		$user = User::where( 'activation_token', $token )->first();
		if ( ! $user ) {
			return response()->json( [
				'message' => 'This activation token is invalid.'
			], 404 );
		}
		$user->active           = true;
		$user->activation_token = '';
		$user->save();

		return $user;
	}
}
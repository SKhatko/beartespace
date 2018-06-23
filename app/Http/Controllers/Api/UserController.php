<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller {

	public function store( Request $request ) {

		$user = User::find( $request['id'] );

		$user->update( $request->all() );

		return $user;
	}

	public function uploadPhoto( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			return $request->file( 'file' )->storeAs( '/public/avatars/' . $id, $request->file( 'file' )->getClientOriginalName() );
		}
	}
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use App\Media;

class UserController extends Controller {

	public function store( Request $request ) {

		$user = User::find( $request['id'] );

		$user->update( $request->except( 'photo' ) );

		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $user ];
	}

	public function uploadUserPhoto( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			Media::updateOrCreate( [ 'user_id' => $id ], [
				'name' => $request->file( 'file' )->getClientOriginalName(),
				'folder' => 'user'
			] );

			return $request->file( 'file' )->storeAs( '/public/user/' . $id, $request->file( 'file' )->getClientOriginalName() );
		}
	}
}

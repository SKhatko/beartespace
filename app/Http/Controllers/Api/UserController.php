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


	public function uploadUserAvatar( Request $request, $id ) {

//		$validator = Validator::make($request->all(), [
//			'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:30',
//		]);
//
//		if ($validator->fails()) {
//			return response()->json(['errors'=>$validator->errors()]);
//		}
//

		$this->validate( $request, [
			'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:30',
		] );

		if ( $request->file( 'file' ) ) {

			$user = User::find( $id );

			$avatar = $user->avatar()->updateOrCreate( [ 'id' => $user->avatar_id ], [
				'name'    => $request->file( 'file' )->getClientOriginalName(),
				'user_id' => $user->id,
				'folder'  => '/user/avatar'
			] );


			$request->file( 'file' )->storeAs( '/public/user/avatar/' . $id, $request->file( 'file' )->getClientOriginalName() );

			$user->avatar_id = $avatar->id;
			$user->save();

			return $user->avatar;
		}
	}

	public function uploadUserImage( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			$user = User::find( $id );

			$image = $user->image()->updateOrCreate( [ 'id' => $user->image_id ], [
				'name'    => $request->file( 'file' )->getClientOriginalName(),
				'user_id' => $user->id,
				'folder'  => '/user/image'
			] );

			$request->file( 'file' )->storeAs( '/public/user/image/' . $id, $request->file( 'file' )->getClientOriginalName() );

			$user->image_id = $image->id;
			$user->save();

			return $user->image;
		}
	}
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller {

	public function show() {
		return auth()->user();
	}

	public function checkUsername( $username = null) {

		$username = str_slug( $username );

		$user = User::whereUserName( $username )->first();

		if ( $user && $user->id !== auth()->user()->id ) {
			return '';
		} else {
			return $username;
		}
	}

	public function update( Request $request ) {

		$user = auth()->user();

		$user->update( $request->except( [ 'avatar', 'image', 'avatar_url', 'image_url', 'profile_premium_add', 'profile_education_add', 'profile_inspiration_add', 'profile_background_image_add', 'profile_exhibition_add'] ) );

		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $user ];
	}

	public function toggleFavouriteArtwork( Request $request, $id ) {

		$user = auth()->user();

		$artworksCount = $user->favouriteArtworks()->count();

		$user->favouriteArtworks()->toggle( $id );

		if ( $user->favouriteArtworks()->count() > $artworksCount ) {
			return [
				'status'  => 'success',
				'message' => 'Artwork Added to Favourites',
				'data'    => $user->favouriteArtworks
			];
		} else {
			return [
				'status'  => 'success',
				'message' => 'Artwork Removed from Favourites',
				'data'    => $user->favouriteArtworks
			];
		}
	}

	public function toggleFollowedUser( Request $request, $id ) {

		$user = auth()->user();

		$followedCount = $user->followedUsers()->count();

		$user->followedUsers()->toggle( $id );

		if ( $user->followedUsers()->count() > $followedCount ) {
			return [
				'status'  => 'success',
				'message' => 'Artist added to followed',
				'data'    => $user->followedUsers
			];
		} else {
			return [
				'status'  => 'success',
				'message' => 'Artist unfollowed',
				'data'    => $user->followedUsers
			];
		}
	}

	public function destroy( Request $request ) {

		$user     = User::findOrFail( $request->id );
		$userName = $user->name;
		$user->forceDelete();

		return [
			'status'  => 'success',
			'message' => $userName . ' Removed from beartespace',
			'data'    => $user
		];
	}

	public function uploadUserAvatar( Request $request ) {

		// validate the uploaded file
		$validation = $request->validate( [
			'file' => 'required|image|mimes:jpeg,jpg,png|max:2048'
		] );

		$user = auth()->user();

		$file      = $validation['file']; // get the validated file
		$extension = $file->getClientOriginalExtension();
		$filename  = 'avatar-' . time() . '.' . $extension;
		$file->storeAs( 'public/user/' . $user->id, $filename );

		$user->avatar()->updateOrCreate( [ 'avatar_id' => $user->id ], [
			'name'    => $filename,
			'user_id' => $user->id,
			'folder'  => '/user',
			'url'     => null
		] );

		return [ 'status' => 'success', 'message' => 'Profile avatar saved', 'data' => $user->avatar_url ];

//		$base64 = $request->input( 'avatar' );
//
////			$base64 = 'data:image/png;base64,asdfla;sdlkfj;
//
//		$user = auth()->user();
//
//		$imageName = $user->name . ' avatar.png';
//
//		$user->avatar()->updateOrCreate( [ 'avatar_id' => $user->id ], [
//			'name'    => $imageName,
//			'user_id' => $user->id,
//			'folder'  => '/user',
//			'url'     => $base64 ? null : '/images/user-placeholder-image.png'
//		] );
//
//		if ( $base64 ) {
//			list( $baseType, $image ) = explode( ';', $base64 );
//			list( , $image ) = explode( ',', $image );
//			$image = base64_decode( $image );
//			Storage::put( 'public/user/' . $user->id . '/' . $imageName, $image, 'public' );
//		}
//
//		return [ 'status' => 'success', 'message' => 'Avatar saved', 'data' => $user->avatar ];
	}

	public function uploadUserImage( Request $request ) {

		// validate the uploaded file
		$validation = $request->validate( [
			'file' => 'required|image|mimes:jpeg,jpg,png|max:2048'
		] );

		$user = auth()->user();

		$file      = $validation['file']; // get the validated file
		$extension = $file->getClientOriginalExtension();
		$filename  = 'image-' . time() . '.' . $extension;
		$file->storeAs( 'public/user/' . $user->id, $filename );

		$user->image()->updateOrCreate( [ 'image_id' => $user->id ], [
			'name'    => $filename,
			'user_id' => $user->id,
			'folder'  => '/user',
			'url'     => null
		] );

		return [ 'status' => 'success', 'message' => 'Profile image saved', 'data' => $user->image_url ];


//		if ( $request->file( 'file' ) ) {
//
//			$user = auth()->user();
//
//			$user->image()->updateOrCreate( [ 'image_id' => $user->id ], [
//				'name'    => $request->file( 'file' )->getClientOriginalName(),
//				'user_id' => $user->id,
//				'folder'  => '/user',
//				'url'     => null
//			] );
//
//			$request->file( 'file' )->storeAs( '/public/user/' . $user->id, $request->file( 'file' )->getClientOriginalName() );
//
//			return [ 'status' => 'success', 'message' => 'Profile image saved', 'data' => $user->image ];
//		}
	}
}

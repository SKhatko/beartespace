<?php

namespace App\Http\Controllers\Api;

use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller {

	public function show() {
		return auth()->user();
	}

	public function checkUsername( $username = null ) {

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

		$user->update( $request->except( [
			'avatar',
			'image',
			'avatar_url',
			'image_url',
			'profile_premium_add',
			'profile_education_add',
			'profile_inspiration_add',
			'profile_background_image_add',
			'profile_exhibition_add'
		] ) );

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

		$validation = $request->validate( [
			'file' => 'required|image|mimes:jpeg,jpg,png|max:2048'
		] );

		$user = auth()->user();

		if ( $user->avatar ) {
			$user->avatar->delete();
			$user->avatar()->dissociate();
		}

		$file     = $validation['file'];
		$fileName = time() . '-' . str_random( 60 ) . '.' . $request->file( 'file' )->getClientOriginalExtension();

		$file->storeAs( 'public/user-avatar/', $fileName );

		$image = Media::create( [
			'original_name' => $file->getClientOriginalName(),
			'name'          => $fileName,
			'slug'          => str_slug( $request->file( 'file' )->getClientOriginalName() ),
			'folder'        => '/user-avatar'
		] );

		$image->save();
		$user->avatar()->associate( $image );
		$user->save();

		return [ 'status' => 'success', 'message' => 'Profile avatar saved', 'data' => $user->avatar_url ];

	}

	public function uploadUserImage( Request $request ) {

		$validation = $request->validate( [
			'file' => 'required|image|mimes:jpeg,jpg'
		] );

		$user = auth()->user();

		if ( $user->image ) {
			$user->image->delete();
		}

		$file      = $validation['file']; // get the validated file
		$fileName  = time() . '-' . str_random( 60 ) . '.' . $request->file( 'file' )->getClientOriginalExtension();

		$file->storeAs( 'public/user-image/', $fileName );

		$image = Media::create( [
			'original_name' => $file->getClientOriginalName(),
			'name'          => $fileName,
			'slug'          => str_slug( $request->file( 'file' )->getClientOriginalName() ),
			'folder'        => '/user-image'
		] );

		$image->save();
		$user->image()->associate( $image );
		$user->save();

		return [ 'status' => 'success', 'message' => 'Profile background saved', 'data' => $user->image_url ];
	}
}

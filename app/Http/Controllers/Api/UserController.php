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

	public function checkUsername( Request $request ) {

		$requestProfileName = str_slug( $request->input( 'profile_name' ) );
		$user            = auth()->user();

		if ( in_array( $requestProfileName, [
			'confirm-email',
			'subscription',
			'search',
			'login',
			'home',
			'auction',
			'artwork',
			'article',
			'artist',
			'contact-form',
			'lead',
			'page',
			'language',
			'currency',
			'cart',
			'checkout',
			'address',
			'about',
			'rules',
			'shipping',
			'dashboard'
		] ) ) {
			return '';
		}

		$users = User::where( 'id', '!=', $user->id )->whereProfileName( $requestProfileName )->get();

		if ( $users->count() ) {
			return '';
		}

		return $requestProfileName;
	}

	public function update( Request $request ) {

		$user = auth()->user();

		$user->update( $request->except( [
			'avatar',
			'image',
			'avatar_url',
			'image_url',
		] ) );

		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $user ];
	}

	public function toggleFavoriteArtwork( Request $request, $id ) {

		$user = auth()->user();

		$artworksCount = $user->favoriteArtworks()->count();

		$user->favoriteArtworks()->toggle( $id );

		if ( $user->favoriteArtworks()->count() > $artworksCount ) {
			return [
				'status'  => 'success',
				'message' => 'Artwork Added to Favorites',
				'data'    => $user->favoriteArtworks
			];
		} else {
			return [
				'status'  => 'success',
				'message' => 'Artwork Removed from Favorites',
				'data'    => $user->favoriteArtworks
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
		$fileName = uniqid( time() . '-' ) . '.' . $request->file( 'file' )->getClientOriginalExtension();

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

		return [ 'status' => 'success', 'message' => 'Profile avatar saved', 'data' => $image ];
	}

	public function uploadUserImage( Request $request ) {

		$validation = $request->validate( [
			'file' => 'required|image|mimes:jpeg,jpg'
		] );

		$user = auth()->user();

		if ( $user->image ) {
			$user->image->delete();
			$user->image()->dissociate();
		}

		$file     = $validation['file']; // get the validated file
		$fileName = uniqid( time() . '-' ) . '.' . $request->file( 'file' )->getClientOriginalExtension();

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

		return [ 'status' => 'success', 'message' => 'Profile background saved', 'data' => $image ];
	}
}

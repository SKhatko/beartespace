<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\User;
use Braintree\ClientToken;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SellController extends Controller {

	public function sell() {
		return view( 'sell.index' );
	}

	public function profileName( $usertype = null ) {

		$user = [
			'profile_name' => auth()->user()->profile_name,
			'seller_type' => $usertype ?? auth()->user()->seller_type
		];

		return view( 'sell.profile-name', compact( 'user' ) );
	}

	public function postProfileName( Request $request ) {

		$user = auth()->user();

		$request->validate( [
			'seller_type' => 'required',
			'profile_name' => [ 'required', 'max:25', Rule::unique( 'users' )->ignore( $user->id ) ]
		] );

		$user->profile_name = $request->profile_name;
		$user->seller_type = $request->seller_type;
		$user->seller_status = 0;
		$user->save();

		return redirect( '/sell/profile' );
	}

	public function profile() {

		return view( 'sell.profile' );
	}

	public function artworks() {

		$title = 'My artworks';

		$user = auth()->user();

//		$artworks = Artwork::orderBy( 'id', 'desc' )->with( 'images' )->get();
		$artworks = $user->artworks()->orderBy( 'id', 'desc' )->with( 'images' )->get();

		return view( 'sell.artworks', compact( 'title', 'artworks' ) );
	}

	public function createArtwork() {
		return view( 'sell.artwork' );
	}

	public function editArtwork( $id ) {

		$artwork = Artwork::whereId( $id )->with( 'images' )->firstOrFail();

		return view( 'sell.artwork', compact( 'artwork' ) );
	}

	public function apply( Request $request ) {

		$user = auth()->user();

		$user->seller = true;
		$user->save();

		return redirect( '/dashboard' );
	}
}

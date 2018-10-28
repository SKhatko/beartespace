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

	public function profileName() {
		return view('sell.profile-name');
	}

	public function postProfileName(Request $request) {

		$user = auth()->user();

		$request->validate( [
			'user_name' => ['required', 'max:25', Rule::unique('users')->ignore($user->id)]
		] );


		$user->user_name = $request->user_name;
		$user->save();

		return redirect('/sell/profile');
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

	public function payments() {

		$user = auth()->user();

		if ( $user->hasBraintreeId() ) {
			$clientToken = ClientToken::generate( [ 'customerId' => $user->braintree_id ] );
		} else {
			// TODO move to .env
			$clientToken = 'sandbox_9qqqx29m_8zf5jpxstv3pkjwy';
		}

		return view( 'sell.payments', compact( 'clientToken' ) );
	}

	public function postPayments(Request $request) {

		$user = auth()->user();

		$user->seller = true;
		$user->save();

		return redirect('/dashboard');
	}
}

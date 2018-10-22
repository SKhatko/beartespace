<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\User;
use Braintree\ClientToken;
use Illuminate\Http\Request;

class SellController extends Controller {

	public function sell() {

		return view( 'sell.index' );
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
}

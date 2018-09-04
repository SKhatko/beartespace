<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artwork;
use App\Country;

class AuctionController extends Controller
{
	public function index() {

		$countries = Country::all( 'country_name', 'id', 'citizenship' );

		$artworks = Artwork::auction()->get();

		return view( 'auction.index', compact( 'artworks', 'countries' ) );

	}

	public function show( $id ) {

		$auction = Artwork::find( $id );

		return view( 'auction.show', compact( 'auction' ) );
	}
}

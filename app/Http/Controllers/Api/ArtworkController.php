<?php

namespace App\Http\Controllers\Api;

use App\Artwork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtworkController extends Controller
{
	public function store( Request $request ) {

		$artwork = Artwork::find( $request['id'] );

		$artwork->update( $request->all() );

		return $artwork;
	}

	public function uploadPhoto( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			return $request->file( 'file' )->storeAs( '/public/artworks/' . $id, $request->file( 'file' )->getClientOriginalName() );
		}
	}
}

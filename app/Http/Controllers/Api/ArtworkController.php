<?php

namespace App\Http\Controllers\Api;

use App\Artwork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtworkController extends Controller
{
	public function store( Request $request ) {

		$artwork = Artwork::updateOrCreate( $request->all() );

		return ['status'=> 'success', 'message' => 'Your Artwork is Saved and will be available after approve', 'data' => $artwork];
	}

	public function uploadPhoto( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			return $request->file( 'file' )->storeAs( '/public/artworks/' . $id, $request->file( 'file' )->getClientOriginalName() );
		}
	}
}

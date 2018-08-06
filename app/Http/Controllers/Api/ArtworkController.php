<?php

namespace App\Http\Controllers\Api;

use App\Artwork;
use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;

class ArtworkController extends Controller {

	public function store( Request $request ) {

		$artwork = Artwork::updateOrCreate( [ 'id' => $request->input( 'id' ) ], $request->except( 'images' ) );

//		return array_pluck($request->input('images'), 'name');
//		$artworkImageIds = array_pluck($request->input('images'), 'name');

//		Media::whereArtworkId($request->input( 'id' ))->whereNotIn('id', $artworkImageIds)->delete();


		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $artwork ];
	}

	public function uploadArtworkImage( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			Media::updateOrCreate( [
				'artwork_id' => $id,
				'name'       => $request->file( 'file' )->getClientOriginalName(),
			], [
				'artwork_id' => $id,
				'name'       => $request->file( 'file' )->getClientOriginalName(),
				'folder'     => 'artwork'
			] );

			return $request->file( 'file' )->storeAs( '/public/artwork/' . $id, $request->file( 'file' )->getClientOriginalName() );
		}
	}

	public function removeArtworkImage( Request $request, $id ) {

		Media::whereArtworkId( $id )->whereName( $request->input( 'name' ) )->first()->delete();

		$images = Media::whereArtworkId( $id )->get();

		return [ 'status' => 'success', 'message' => 'Image deleted', 'data' => $images ];
	}

}

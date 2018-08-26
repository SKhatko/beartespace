<?php

namespace App\Http\Controllers\Api;

use App\Artwork;
use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cart;

class ArtworkController extends Controller {

	public function store( Request $request ) {

		$user = auth()->user();

		$artwork = Artwork::updateOrCreate( [ 'id'      => $request->input( 'id' ),
		                                      'user_id' => $user->id
		], array_merge( $request->except( [ 'images', 'formatted_price', 'artwork_options' ] ), [ 'user_id' => $user->id ] ) );

		$artwork = $artwork->whereId( $artwork->id )->with( 'images' )->first();

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

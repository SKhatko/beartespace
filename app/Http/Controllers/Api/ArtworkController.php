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

		$artwork = Artwork::updateOrCreate( [
			'id'      => $request->input( 'id' ),
			'user_id' => $user->id
		], array_merge( $request->except( [
			'image',
			'image_url',
			'images',
			'formatted_price',
			'artwork_options_add',
			'artwork_inspiration_add',
			'artwork_interior_add'
		] ), [ 'user_id' => $user->id ] ) );

		$artwork = $artwork->whereId( $artwork->id )->with( 'images' )->first();

		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $artwork ];
	}

	public function uploadArtworkImage( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			$artwork = Artwork::find( $id );

			if ( $artwork->image ) {
				$artwork->image->delete();
			}

			$fileName = time() . '-' . str_random( 60 ) . '.' . $request->file( 'file' )->getClientOriginalExtension();

			$request->file( 'file' )->storeAs( '/public/artwork-image', $fileName );

			$image = Media::create( [
				'original_name' => $request->file( 'file' )->getClientOriginalName(),
				'name'          => $fileName,
				'slug'          => str_slug( $request->file( 'file' )->getClientOriginalName() ),
				'folder'        => '/artwork-image'
			] );

			$image->save();
			$artwork = $artwork->image()->associate($image);
			$artwork->save();

			return [ 'status' => 'success', 'message' => 'Image Uploaded', 'data' => $artwork->image_url ];
		}
	}

	public function uploadArtworkImages( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			$artwork = Artwork::find( $id );

			$fileName = time() . '-' . str_random( 60 ) . '.' . $request->file( 'file' )->getClientOriginalExtension();

			$request->file( 'file' )->storeAs( '/public/artwork-images', $fileName );

			$image = $artwork->images()->create( [
				'original_name' => $request->file( 'file' )->getClientOriginalName(),
				'name'          => $fileName,
				'slug'          => str_slug( $request->file( 'file' )->getClientOriginalName() ),
				'folder'        => '/artwork-images'
			] );

			$artwork = $artwork->fresh();

			return [ 'status' => 'success', 'message' => 'Image Uploaded', 'data' => $artwork->images ];
		}
	}

	public function removeArtworkImage( Request $request, $id ) {

		$artwork = Artwork::find( $id );

		$artwork->images()->find( $request->input( 'id' ) )->delete();

		$artwork = $artwork->fresh();

		return [ 'status' => 'success', 'message' => 'Image deleted', 'data' => $artwork->images ];
	}

}

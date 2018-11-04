<?php

namespace App\Http\Controllers\Api;

use App\Artwork;
use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
		] ), [ 'user_id' => $user->id ] ) );

		$ids = array_pluck( $request->input( 'images' ), 'id' );

		$images = Media::findMany( $ids );

		$artwork->images()->sync( $images );

		$artwork = $artwork->whereId( $artwork->id )->with( 'images', 'image' )->first();

		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $artwork ];
	}

	public function uploadArtworkImage( Request $request ) {

		$fileName = uniqid( time() . '-' ) . '.' . $request->file( 'file' )->getClientOriginalExtension();

		$request->file( 'file' )->storeAs( '/public/artwork-image', $fileName );

		$image = Media::create( [
			'original_name' => $request->file( 'file' )->getClientOriginalName(),
			'name'          => $fileName,
			'slug'          => str_slug( $request->file( 'file' )->getClientOriginalName() ),
			'folder'        => '/artwork-image'
		] );

		return [ 'status' => 'success', 'message' => 'Primary Image Uploaded', 'data' => $image ];
	}

	public function uploadArtworkImages( Request $request ) {

		$fileName = uniqid( time() . '-' ) . '.' . $request->file( 'file' )->getClientOriginalExtension();

		$request->file( 'file' )->storeAs( '/public/artwork-images', $fileName );

		$image = Media::create( [
			'original_name' => $request->file( 'file' )->getClientOriginalName(),
			'name'          => $fileName,
			'slug'          => str_slug( $request->file( 'file' )->getClientOriginalName() ),
			'folder'        => '/artwork-images'
		] );

		return [ 'status' => 'success', 'message' => 'Primary Image Uploaded', 'data' => $image ];
	}


}

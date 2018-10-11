<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller {

	public function store( Request $request ) {

		$article = auth()->user()->articles()->create( array_merge( $request->except( [
			'image',
			'image_url',
			'images',
		] ) ) );



//		$article = Article::updateOrCreate( [
//			'id'      => $request->input( 'id' ),
//			'user_id' => $user->id
//		], array_merge( $request->except( [
//			'image',
//			'image_url',
//			'images',
//		] ), [ 'user_id' => $user->id ] ) );

//		if ( $request->input( 'images' ) ) {

//		$ids = array_pluck( $request->input( 'images' ), 'id' );

//		$images = Media::findMany( $ids );

//		$article->images()->sync( $images );
//		}

		$article = $article->whereId( $article->id )->with( 'images', 'image' )->first();

		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $article ];
	}

	public function update( Request $request ) {

		$article = Article::findOrFail( $request->id );

		$article->update( $request->all() );

		return $article;
	}

	public function uploadArticleImage( Request $request ) {

		if ( $request->file( 'file' ) ) {

			$fileName = uniqid( time() . '-' ) . '.' . $request->file( 'file' )->getClientOriginalExtension();

			$request->file( 'file' )->storeAs( '/public/article-image', $fileName );

			$image = Media::create( [
				'original_name' => $request->file( 'file' )->getClientOriginalName(),
				'name'          => $fileName,
				'slug'          => str_slug( $request->file( 'file' )->getClientOriginalName() ),
				'folder'        => '/article-image'
			] );

			return [ 'status' => 'success', 'message' => 'Primary Image Uploaded', 'data' => $image ];
		}
	}

}

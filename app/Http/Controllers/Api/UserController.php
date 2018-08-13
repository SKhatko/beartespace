<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\User;
use Intervention\Image\Facades\Image;

class UserController extends Controller {

	public function show() {
		return auth()->user();
	}

	public function store( Request $request ) {

		$user = auth()->user();

		$user->update( $request->except( [ 'image', 'avatar' ] ) );

		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $user ];
	}

	public function toggleFavouriteArtwork( Request $request, $id ) {

		$user = auth()->user();

		$artworksCount = $user->favouriteArtworks()->count();

		$user->favouriteArtworks()->toggle( $id );

		if ( $user->favouriteArtworks()->count() > $artworksCount ) {
			return [ 'status'  => 'success',
			         'message' => 'Artwork Added to Favourites',
			         'data'    => $user->favouriteArtworks
			];
		} else {
			return [ 'status'  => 'success',
			         'message' => 'Artwork Removed from Favourites',
			         'data'    => $user->favouriteArtworks
			];
		}
	}

	public function uploadUserAvatar( Request $request ) {

		// validate the uploaded file
		$validation = $request->validate([
			'file' => 'required|image|mimes:jpeg,jpg,png|max:2048'
		]);

		$user = auth()->user();

		$file      = $validation['file']; // get the validated file
		$extension = $file->getClientOriginalExtension();
		$filename  = 'avatar-' . time() . '.' . $extension;
		$path      = $file->storeAs('public/user/' . $user->id, $filename);

//		return $path;

//		$img = Image::make($path)
//		            ->resize(320, 240)->save();
//		            ->save(storage_path('public/user/' . $user->id . '/' . $filename));
//		$image = Image::make($path)->resize(300, 200);

//		$image = Image::make(storage_path($path))->resize(300, 200);
//		$image->save($path);


		$user->avatar()->updateOrCreate( [ 'avatar_id' => $user->id ], [
			'name'    => $filename,
			'user_id' => $user->id,
			'folder'  => '/user',
			'url'     => null
		] );

//		return $path;
		return [ 'status' => 'success', 'message' => 'Profile avatar saved', 'data' => $user->avatar ];


		if ( $request->file( 'file' ) ) {



//			$file->storeAs('/public/user/' . $user->id, 'avatar.jpg');
//
//			$pathtoimage = 'public/user/'.$user->id.'/avatar.jpg';
//
//			$img = Image::make(request()->file('file')->getRealPath());
//			$img->sharpen(9);
//			$img->resize(null, 290, function ($constraint) {
//				$constraint->aspectRatio();
//			});
//			$img->crop(290,290);
//			$img->save($pathtoimage);



//			$request->file( 'file' )->storeAs( '/public/user/' . $user->id, $request->file( 'file' )->getClientOriginalName() );

		}

//		$base64 = $request->input( 'avatar' );
//
////			$base64 = 'data:image/png;base64,asdfla;sdlkfj;
//
//		$user = auth()->user();
//
//		$imageName = $user->name . ' avatar.png';
//
//		$user->avatar()->updateOrCreate( [ 'avatar_id' => $user->id ], [
//			'name'    => $imageName,
//			'user_id' => $user->id,
//			'folder'  => '/user',
//			'url'     => $base64 ? null : '/images/user-placeholder-image.png'
//		] );
//
//		if ( $base64 ) {
//			list( $baseType, $image ) = explode( ';', $base64 );
//			list( , $image ) = explode( ',', $image );
//			$image = base64_decode( $image );
//			Storage::put( 'public/user/' . $user->id . '/' . $imageName, $image, 'public' );
//		}
//
//		return [ 'status' => 'success', 'message' => 'Avatar saved', 'data' => $user->avatar ];
	}

	public function uploadUserImage( Request $request ) {

		if ( $request->file( 'file' ) ) {

			$user = auth()->user();

			$user->image()->updateOrCreate( [ 'image_id' => $user->id ], [
				'name'    => $request->file( 'file' )->getClientOriginalName(),
				'user_id' => $user->id,
				'folder'  => '/user',
				'url'     => null
			] );

			$request->file( 'file' )->storeAs( '/public/user/' . $user->id, $request->file( 'file' )->getClientOriginalName() );

			return [ 'status' => 'success', 'message' => 'Profile image saved', 'data' => $user->image ];
		}
	}
}

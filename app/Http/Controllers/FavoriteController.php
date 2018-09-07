<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller {

	public function toggleFavoriteArtwork( Request $request, $id ) {

		$user = auth()->user();

		$user->favoriteArtworks()->toggle( $id );

		return redirect()->back();

	}
}

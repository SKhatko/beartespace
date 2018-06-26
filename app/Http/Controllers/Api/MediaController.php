<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{

	public function uploadUserPhoto( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			return $request->file( 'file' )->storeAs( '/public/avatars/' . $id, $request->file( 'file' )->getClientOriginalName() );
		}
	}

    public function uploadArtworkImage(Request $request, $id) {

	    if ( $request->file( 'file' ) ) {

		    return $request->file( 'file' )->storeAs( '/public/artworks/' . $id, $request->file( 'file' )->getClientOriginalName() );
	    }
    }

    public function removeArtworkImage(Request $request, $id) {

    }
}

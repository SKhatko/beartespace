<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Media;

class MediaController extends Controller
{

	public function uploadUserPhoto( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			Media::updateOrCreate(['user_id' => $id], ['name' => $request->file( 'file' )->getClientOriginalName(), 'folder' => 'user' ]);

			return $request->file( 'file' )->storeAs( '/public/user/' . $id, $request->file( 'file' )->getClientOriginalName() );
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

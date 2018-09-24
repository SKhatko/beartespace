<?php

namespace App\Http\Controllers;

use App\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtworkController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$title = 'My artworks';

//
//		$order = auth()->user()->orders()->first();
//
////		dd($order->shoppingcart->content);
//
//		foreach ( $order->shoppingcart->content as $item ) {
//
//			dump( $item->model );
////					return new \App\Mail\ArtworkSold($order, $item->model);
//		}
//
//
//		return $order;
//
//		Mail::to( $artwork->user )->send( new OrderPaid( $order ) );

		$user = Auth::user();

		$artworks = $user->artworks()->orderBy( 'id', 'desc' )->with( 'images' )->get();

		return view( 'dashboard.artworks.index', compact( 'title', 'artworks' ) );
	}

	public function adminPendingArtworks() {
		$title = trans( 'app.pending_ads' );
		$ads   = Artwork::with( 'city', 'country', 'state' )->whereStatus( '0' )->orderBy( 'id', 'desc' )->paginate( 20 );

		return view( 'admin.all_ads', compact( 'title', 'ads' ) );
	}

	public function adminBlockedArtworks() {
		$title = trans( 'app.blocked_ads' );
		$ads   = Artwork::with( 'city', 'country', 'state' )->whereStatus( '2' )->orderBy( 'id', 'desc' )->paginate( 20 );

		return view( 'admin.all_ads', compact( 'title', 'ads' ) );
	}

	public function pendingArtworks() {
		$title = trans( 'app.my_ads' );

		$user = Auth::user();
		$ads  = $user->artworks()->whereStatus( '0' )->orderBy( 'id', 'desc' )->paginate( 20 );

		return view( 'admin.pending_ads', compact( 'title', 'ads' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$title = 'Upload New Artwork';

		return view( 'dashboard.artworks.create', compact( 'title' ) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {

		$title = 'Edit Artwork';

		$artwork = Artwork::whereId( $id )->with( 'images' )->firstOrFail();

//		return $artwork;
		$user = auth()->user();

//		return $artwork;

		if ( $artwork->user_id === $user->id || $user->isAdmin() ) {
			return view( 'dashboard.artworks.edit', compact( 'title', 'artwork' ) );
		} else {
			return redirect( route( 'dashboard' ) )->with( 'error', trans( 'app.access_restricted' ) );
		}

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {

	}


	public function adStatusChange( Request $request ) {
		$slug = $request->slug;
		$ad   = Artwork::whereSlug( $slug )->first();
		if ( $ad ) {
			$value = $request->value;

			$ad->status = $value;
			$ad->save();

			if ( $value == 1 ) {
				return [ 'success' => 1, 'msg' => trans( 'app.ad_approved_msg' ) ];
			} elseif ( $value == 2 ) {
				return [ 'success' => 1, 'msg' => trans( 'app.ad_blocked_msg' ) ];
			} elseif ( $value == 3 ) {
				return [ 'success' => 1, 'msg' => trans( 'app.ad_archived_msg' ) ];
			}
		}

		return [ 'success' => 0, 'msg' => trans( 'app.error_msg' ) ];

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Request $request, $id ) {
		$artwork = Artwork::find( $id );

		$artwork->images()->delete();
		$artwork->delete();
	}
}

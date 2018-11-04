<?php

namespace App\Http\Controllers;


use App\Artwork;
use App\Favorite;
use App\Media;
use App\User;
use App\Country;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use PragmaRX\Countries\Package\Countries;


class UserController extends Controller {

	public function index() {

		$title = trans( 'portal.users' );

		$users = User::all();

		return view( 'dashboard.user.index', compact( 'title', 'users' ) );
	}

	public function seller( $profilename ) {

		$seller = User::where( 'profile_name', $profilename )->with( 'image', 'avatar', 'artworks.images' )->firstOrFail();

		return view( 'seller.show', compact( 'seller' ) );
	}

	public function person( $id ) {

		$person = User::find($id)->with( 'image', 'avatar', 'artworks.images' )->firstOrFail();

		return $person;

		return view( 'seller.show', compact( 'person' ) );
	}

	public function profile() {

		$title = trans( 'portal.profile' );

		$user = auth()->user();

		return view( 'dashboard.user.profile', compact( 'title', 'user' ) );
	}

	public function accountSettings() {
		return view( 'dashboard.user.account' );
	}

	public function people( Request $request ) {

		$artists = User::query()->seller();

		if ( $request->input( 'artist' ) ) {
			$artist        = $request->input( 'artist' );
			$userNameArray = explode( ' ', $artist );

			foreach ( $userNameArray as $userNamePart ) {
				$artists->whereRaw( 'LOWER(first_name) LIKE ?', '%' . $userNamePart . '%' )
				        ->orWhereRaw( 'LOWER(last_name) LIKE ?', '%' . $userNamePart . '%' );
			}
		}

		if ( $request->input( 'country' ) ) {
			$queries = explode( ',', $request->input( 'country' ) );
			$artists->whereIn( 'country_id', $queries );
		}

		if ( $request->input( 'profession' ) ) {
			$queries = explode( ',', $request->input( 'profession' ) );
			foreach ( $queries as $query ) {
				$artists->whereRaw( 'LOWER(profession) LIKE ?', '%' . $query . '%' );
			}
		}

		if ( $request->input( 'medium' ) ) {
			$queries = explode( ',', $request->input( 'medium' ) );
			foreach ( $queries as $query ) {
				$artists->with( 'artworks' )->whereHas( 'artworks', function ( $q ) use ( $query ) {
					$q->whereRaw( 'LOWER(medium) LIKE ?', '%' . $query . '%' );
				} );
			}
		}

		if ( $request->input( 'direction' ) ) {
			$queries = explode( ',', $request->input( 'direction' ) );
			foreach ( $queries as $query ) {
				$artists->with( 'artworks' )->whereHas( 'artworks', function ( $q ) use ( $query ) {
					$q->whereRaw( 'LOWER(direction) LIKE ?', '%' . $query . '%' );
				} );
			}
		}

		if ( $request->input( 'selected' ) ) {
			$artists = $artists->whereIn( 'id', option('artists_of_the_week') );
		}

		$items = 15;

		if ( $request->has( 'items' ) && $request->input( 'items' ) > 1 ) {
			$items = $request->get( 'items' );
		}

		$artists = $artists->paginate( $items );

		return view( 'seller.index', compact( 'artists' ) );
	}

	public function artist( $id ) {

		$artist = User::where( 'id', $id )->with( 'image', 'avatar', 'artworks.images' )->first();

		return view( 'artist.show', compact( 'artist' ) );
	}

	public function favoriteArtworks( $category = 'artworks' ) {

		$user = auth()->user();

		$artworks = $user->favoriteArtworks()->orderBy( 'id', 'desc' )->get();
		$artists  = $user->followedUsers()->orderBy( 'id', 'desc' )->get();

		return view( 'dashboard.user.favorites', compact( 'artworks', 'artists', 'user', 'category' ) );
	}

	public function orders() {

		$user = auth()->user();

		$orders = $user->orders()->get();

		$order = auth()->user()->orders()->first();

		return view( 'dashboard.user.orders', compact( 'orders', 'user' ) );
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
		$user = User::findOrFail($id);

		return $user;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		$user = User::findOrFail($id);

		return view('dashboard.user.edit', compact('user'));
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}

	public function changePasswordPost( Request $request ) {

		$this->validate( $request, [
			'old_password'              => 'required',
			'new_password'              => 'required|confirmed',
			'new_password_confirmation' => 'required',
		] );

		$old_password = $request->old_password;
		$new_password = $request->new_password;

		if ( Auth::check() ) {
			$logged_user = Auth::user();

			if ( Hash::check( $old_password, $logged_user->password ) ) {
				$logged_user->password = Hash::make( $new_password );
				$logged_user->save();

				return redirect()->back()->with( [ 'message' => [ 'message' => 'Password changed successfully' ] ] );
			}

			return redirect()->back()->with( 'inline-error', 'Wrong Old password' );
		}
	}
}

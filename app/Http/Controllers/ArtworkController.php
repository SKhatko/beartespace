<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class ArtworkController extends Controller {

	public function artworks( Request $request ) {

		$artworks = Artwork::query()->auction( false )->notSold()->available()->quantity()->with( 'image' );

		if ( $request->input( 'artist' ) ) {
			$artist = $request->input( 'artist' );

			$artworks->with( 'user' )->whereHas( 'user', function ( $user ) use ( $artist ) {
				$userNameArray = explode( ' ', $artist );
				foreach ( $userNameArray as $userNamePart ) {
					$user->whereRaw( 'LOWER(first_name) LIKE ?', '%' . $userNamePart . '%' )
					     ->orWhereRaw( 'LOWER(last_name) LIKE ?', '%' . $userNamePart . '%' );
				}
			} );
		}

		if ( $request->input( 'artwork' ) ) {
			$artwork = $request->input( 'artwork' );
			$artworks->whereRaw( 'LOWER(name) LIKE ?', '%' . $artwork . '%' );
		}

		if ( $request->input( 'artwork-category' ) ) {
			$queries = explode( ',', $request->input( 'artwork-category' ) );
			foreach ( $queries as $query ) {
				$artworks->whereRaw( 'LOWER(category) LIKE ?', '%' . $query . '%' );
			}
		}

		if ( $request->input( 'medium' ) ) {
			$queries = explode( ',', $request->input( 'medium' ) );
			foreach ( $queries as $query ) {
				$artworks->whereRaw( 'LOWER(medium) LIKE ?', '%' . $query . '%' );
			}
		}

		if ( $request->input( 'direction' ) ) {
			$queries = explode( ',', $request->input( 'direction' ) );
			foreach ( $queries as $query ) {
				$artworks->whereRaw( 'LOWER(direction) LIKE ?', '%' . $query . '%' );
			}
		}

		if ( $request->input( 'theme' ) ) {
			$queries = explode( ',', $request->input( 'theme' ) );
			foreach ( $queries as $query ) {
				$artworks->whereRaw( 'LOWER(theme) LIKE ?', '%' . $query . '%' );
			}
		}

		if ( $request->input( 'country' ) ) {
			$countries = explode( ',', $request->input( 'country' ) );

			$artworks->with( 'user' )->whereHas( 'user', function ( $user ) use ( $countries ) {
				foreach ( $countries as $country ) {
					$user->where( 'country_id', $country );
				}
			} );
		}

		if ( $request->input( 'shape' ) ) {
			$queries = explode( ',', $request->input( 'shape' ) );
			foreach ( $queries as $query ) {
				$artworks->whereRaw( 'LOWER(shape) LIKE ?', '%' . $query . '%' );
			}
		}

		if ( $request->input( 'color' ) ) {
			$queries = explode( ',', $request->input( 'color' ) );
			foreach ( $queries as $query ) {
				$artworks->whereRaw( 'LOWER(color) LIKE ?', '%' . $query . '%' );
			}
		}

		if ( $request->input( 'price_min' ) ) {
			$priceMin = currency( $request->input( 'price_min' ), session( 'currency' ), 'EUR', false );
			$artworks->where( 'price', '>=', $priceMin );
		}

		if ( $request->input( 'price_max' ) ) {
			$priceMax = currency( $request->input( 'price_max' ), session( 'currency' ), 'EUR', false );
			$artworks->where( 'price', '<=', $priceMax );
		}

		if ( $request->input( 'selected' ) ) {
			$artworks = $artworks->where( 'id', Setting::first()->artworks_of_the_week );
		}

		$items = 15;

		if ( $request->has( 'items' ) && $request->input( 'items' ) > 1 ) {
			$items = $request->get( 'items' );
		}

		$artworks = $artworks->with( 'images', 'user' )->paginate( $items );

		return view( 'artwork.index', compact( 'artworks' ) );
	}

	public function artwork( $id, $slug = '' ) {

		$artwork = Artwork::findOrFail( $id )->load( 'images' );

		if ( $slug !== $artwork->slug ) {
			return redirect( $artwork->url );
		}

		$otherArtworks = $artwork->user->artworks()->where( 'id', '!=', $artwork->id )->take( 4 )->with( 'user:id,first_name,last_name,profile_name,name,url' )->get();

		$similarArtworks = Artwork::whereCategory( $artwork->category )->where( 'id', '!=', $artwork->id )->take( 4 )->with( 'user:id,first_name,last_name,profile_name,name,url' )->get();

		return view( 'artwork.show', compact( 'artwork', 'similarArtworks', 'otherArtworks' ) );
	}

	public function index() {
		$title = 'My artworks';

		$user = auth()->user();

		$artworks = $user->artworks()->orderBy( 'id', 'desc' )->with( 'images' )->get();

		return view( 'dashboard.artwork.index', compact( 'title', 'artworks' ) );
	}

	public function create() {

		$title = 'Upload New Artwork';

		return view( 'dashboard.artwork.create', compact( 'title' ) );
	}

	public function edit( $id ) {

		$title = 'Edit Artwork';

		$artwork = Artwork::whereId( $id )->with( 'images' )->firstOrFail();

		$user = auth()->user();

		if ( $artwork->user_id === $user->id || $user->isAdmin() ) {
			return view( 'dashboard.artwork.edit', compact( 'title', 'artwork' ) );
		} else {
			return redirect( route( 'dashboard' ) )->with( 'error', trans( 'app.access_restricted' ) );
		}

	}

	public function destroy( Request $request, $id ) {
		$artwork = Artwork::find( $id );

		$artwork->images()->delete();
		$artwork->image()->delete();
		$artwork->delete();
	}
}

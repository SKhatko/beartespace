<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Article;
use App\Contact_query;
use App\Country;
use App\User;
use Illuminate\Http\Request;
use App\Setting;

class HomeController extends Controller {

	public function index() {

		$articles = Article::where( 'active', 1 )->take( 2 )->get();

		$artwork = Artwork::inRandomOrder()->with( 'images', 'user' )->first();

		$randomArtwork = Artwork::first();

//		return $randomArtwork;

		$auctions = Artwork::auction()->orderBy( 'id', 'desc' )->take( 4 )->get();

		return view( 'index', compact( 'artwork', 'auctions', 'articles', 'randomArtwork' ) );
	}

	public function selectedArtists() {

		$artists = User::whereIn( 'id', Setting::first()->artists_of_the_week )->paginate( 15 );

		return view( 'artist.index', compact( 'artists' ) );
	}

	public function selectedArtworks() {

		$countries = Country::all( 'country_name', 'id', 'citizenship' );

		$artworks = Artwork::whereIn( 'id', Setting::first()->artworks_of_the_week )->with( 'images', 'user.country' )->paginate();

		return view( 'artwork.index', compact( 'artworks', 'countries' ) );
	}

	public function artists( Request $request ) {

		$artists = User::query()->artist();

		foreach ( $artists->get() as $artist ) {
//			dd( $artist->medium );
		}

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

		$items = 5;

		if ( $request->has( 'items' ) && $request->input( 'items' ) > 1 ) {
			$items = $request->get( 'items' );
		}

		$artists = $artists->paginate( $items );

		return view( 'artist.index', compact( 'artists' ) );
	}

	public function artist( $id ) {

		$artist = User::where( 'id', $id )->with( 'image', 'avatar', 'artworks.images' )->first();

//		return $artist->image;
//		return $artist->favouriteArtworks;
		return view( 'artist.show', compact( 'artist' ) );
	}

	public function artistProfile( $artist ) {

		$artist = User::where( 'user_name', $artist )->with( 'image', 'avatar', 'artworks.images' )->firstOrFail();

		return view( 'artist.show', compact( 'artist' ) );

	}

	public function artworks( Request $request ) {

		$artworks = Artwork::query();

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
			$artworks->whereRaw( 'LOWER(title) LIKE ?', '%' . $artwork . '%' );
		}

		if ( $request->input( 'category' ) ) {
			$queries = explode( ',', $request->input( 'category' ) );
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
			$priceMin = currency($request->input( 'price_min' ), session('currency'), 'EUR',false);
			$artworks->where( 'price', '>=', $priceMin );
		}

		if ( $request->input( 'price_max' ) ) {
			$priceMax = currency($request->input( 'price_max' ), session('currency'), 'EUR',false);
			$artworks->where( 'price', '<=', $priceMax );
		}


//		foreach ( $artworks->get() as $artwork ) {
//			dump($artwork->price);
//			dump($artwork->currency);
//			dump( $artwork->price < $priceMax );
//			dump( $artwork->price > $priceMin );
//		}


		$items = 5;

		if ( $request->has( 'items' ) && $request->input( 'items' ) > 1 ) {
			$items = $request->get( 'items' );
		}

		$artworks = $artworks->with( 'images', 'user.country' )->paginate( $items );

		return view( 'artwork.index', compact( 'artworks' ) );
	}

	public function artwork( $id ) {

		$artwork = Artwork::find( $id );

//		return $artwork->image;

		return view( 'artwork.show', compact( 'artwork' ) );
	}

	public function about() {
		return view( 'pages.about' );
	}

	public function rules() {
		return view( 'pages.rules' );
	}

	public function shipping() {
		return view( 'pages.shipping' );
	}

	// Invite routes
	public function inviteArtist() {
		return view( 'invite.artist' );
	}

	public function inviteGallery() {
		return view( 'invite.gallery' );
	}

	public function inviteWriter() {
		return view( 'invite.writer' );
	}

	public function inviteCustomer() {
		return view( 'invite.customer' );
	}


	public function contactForm() {
		$title = trans( 'app.contact_us' );

		return view( 'pages.contact-form', compact( 'title' ) );
	}

	public function contactFormPost( Request $request ) {

		$this->validate( $request, [
			'name'    => 'required',
			'email'   => 'required|email',
			'message' => 'required',
		] );

		Contact_query::create( $request->all() );

		return redirect()->back()->with( 'success', trans( 'app.your_message_has_been_sent' ) );
	}


	public function search( Request $request, $query = null ) {

		// Search query
		$query = trim( $request->input( 'query' ) );

		$artworks = Artwork::whereRaw( 'LOWER(title) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(description) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(inspiration) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(medium) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(direction) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(theme) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(color) LIKE ?', '%' . $query . '%' )
		                   ->get();

//		return $artworks;

		$artists = User::query()->artist();

		$userNameArray = explode( ' ', $query );

		foreach ( $userNameArray as $userNamePart ) {
			$artists->whereRaw( 'LOWER(first_name) LIKE ?', '%' . $userNamePart . '%' )
			        ->orWhereRaw( 'LOWER(last_name) LIKE ?', '%' . $userNamePart . '%' );
		}

		$artists = $artists->paginate( 15 );

		return view( 'search.index', compact( 'artworks', 'artists' ) );
	}

}



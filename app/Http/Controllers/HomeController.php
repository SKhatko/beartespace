<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Article;
use App\Contact_query;
use App\Country;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller {

	public function index() {

		$articles = Article::where( 'active', 1 )->take( 2 )->get();

		$artwork = Artwork::inRandomOrder()->with( 'images', 'user' )->first();

		$auctions = Artwork::auction()->orderBy( 'id', 'desc' )->take( 4 )->get();

		return view( 'index', compact( 'artwork', 'auctions', 'articles' ) );
	}

	public function auctions() {

		$auctions = Artwork::auction()->get();

		return view( 'auction.index', compact( 'auctions' ) );
	}

	public function auction( $id ) {

		$auction = Artwork::find( $id );

		return view( 'auction.show', compact( 'auction' ) );
	}

	public function selections() {

		$artworks = Artwork::active()->limit( 20 )->get();

		return view( 'artwork.index', compact( 'artworks' ) );
	}

	public function selection( $id ) {

		$artwork = Artwork::find( $id );

		return view( 'artwork.show', compact( 'artwork' ) );
	}

	public function artists() {

		$artists = User::artist()->limit( 20 )->get();

		$artist = User::find( 4 );

//		return $artist->artworks->take(3);

		return view( 'artist.index', compact( 'artists' ) );
	}

	public function artist( $id ) {

		$artist = User::where( 'id', $id )->with( 'image', 'avatar', 'artworks.images' )->first();

		return view( 'artist.show', compact( 'artist' ) );
	}

	public function artistProfile( $artist ) {

		$artist = User::where( 'user_name', $artist )->with( 'image', 'avatar', 'artworks.images' )->firstOrFail();

		return view( 'artist.show', compact( 'artist' ) );

	}

	public function artworks( Request $request ) {

		$artworks = Artwork::query();

		if ( $request->all() ) {
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

//			if ( $request->input( 'category' ) ) {
//				$queries = explode( ',', $request->input( 'category' ) );
//				foreach ( $queries as $query ) {
//					$artworks->whereRaw( 'LOWER(category) LIKE ?', '%' . $query . '%' );
//				}
//			}
//
//			if ( $request->input( 'direction' ) ) {
//				$queries = explode( ',', $request->input( 'direction' ) );
//				foreach ( $queries as $query ) {
//					$artworks->whereRaw( 'LOWER(direction) LIKE ?', '%' . $query . '%' );
//				}
//
//			}
//
//			if ( $request->input( 'medium' ) ) {
//				$queries = explode( ',', $request->input( 'medium' ) );
//				foreach ( $queries as $query ) {
//					$artworks->whereRaw( 'LOWER(medium) LIKE ?', '%' . $query . '%' );
//				}
//			}
//
//			if ( $request->input( 'theme' ) ) {
//				$queries = explode( ',', $request->input( 'theme' ) );
//				foreach ( $queries as $query ) {
//					$artworks->whereRaw( 'LOWER(theme) LIKE ?', '%' . $query . '%' );
//				}
//			}
//
//			if ( $request->input( 'color' ) ) {
//				$queries = explode( ',', $request->input( 'color' ) );
//				foreach ( $queries as $query ) {
//					$artworks->whereRaw( 'LOWER(color) LIKE ?', '%' . $query . '%' );
//				}
//			}
//
//			if ( $request->input( 'price' ) ) {
//				$queries = explode( ',', $request->input( 'price' ) );
//				foreach ( $queries as $query ) {
//					$artworks->whereRaw( 'LOWER(color) LIKE ?', '%' . $query . '%' );
//				}
//			}
		} else {
			$artworks = Artwork::limit( 20 )->with( 'images', 'user.country' );
		}

//		return $artworks->with( 'user' )->get();

		$countries = Country::all( 'country_name', 'id', 'citizenship' );

		$artworks = $artworks->limit( 20 )->with( 'images', 'user.country' )->get();

		return view( 'artwork.index', compact( 'artworks', 'countries' ) );
	}

	public function artwork( $id ) {

		$artwork = Artwork::find( $id );

		return view( 'artwork.show', compact( 'artwork' ) );
	}

	public function checkout() {
		return view( 'checkout.checkout' );
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


		// TODO search in Artists, Artworks

		$artworks = Artwork::whereRaw( 'LOWER(title) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(description) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(inspiration) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(medium) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(direction) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(theme) LIKE ?', '%' . $query . '%' )
		                   ->orWhereRaw( 'LOWER(color) LIKE ?', '%' . $query . '%' )
		                   ->get();

//		return $artworks;

		return view( 'search.index', compact( 'artworks', 'artists' ) );
	}

}



<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Article;
use App\Contact_query;
use App\Country;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller {

	public function index() {

		$articles = Article::where( 'active', 1 )->take( 2 )->get();

		$randomArtwork = Artwork::auction(false)->notSold()->available()->quantity()->with('image')->inRandomOrder()->first();

		$artworks = Artwork::auction(false)->notSold()->available()->quantity()->with('image')->inRandomOrder()->take(4)->get();

		$auctions = Artwork::auction()->notSold()->available()->quantity()->with('image')->inRandomOrder()->take( 4 )->get();

		return view( 'index', compact( 'artworks', 'auctions', 'articles', 'randomArtwork' ) );
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

	public function about() {
		return view( 'pages.about' );
	}

	public function rules() {
		return view( 'pages.rules' );
	}

	public function shipping() {
		return view( 'pages.shipping' );
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

		$artworks = Artwork::whereRaw( 'LOWER(name) LIKE ?', '%' . $query . '%' )
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



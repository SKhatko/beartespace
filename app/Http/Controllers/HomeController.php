<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Cart;
use App\Contact_query;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller {

	public function index() {

//		dump( currency()->getUserCurrency() );
//		dump( currency()->config( 'currency' ) );
		// Home page

		$artwork = Artwork::inRandomOrder()->with( 'images', 'user' )->first();

		$auctions = Artwork::auction()->orderBy('id', 'desc')->take(4)->get();


		return view( 'index', compact( 'artwork', 'auctions' ) );
	}

	public function auctions() {

		$auctions = Artwork::auction()->get();

		return view( 'auction.index', compact( 'auctions' ) );
	}

	public function auction( $id ) {

		$auction = Artwork::find( $id );

		return view( 'auction.show', compact( 'auction' ) );
	}

	public function artists() {

		$artists = User::artist()->limit( 20 )->get();

		return view( 'artist.index', compact( 'artists' ) );
	}

	public function artist( $id ) {

		$artist = User::find( $id );

		return view( 'artist.show', compact( 'artist' ) );
	}

	public function artworks() {

		$artworks = Artwork::active()->limit( 20 )->get();

		return view( 'artwork.index', compact( 'artworks' ) );
	}

	public function sculptures() {

		$sculptures = Artwork::sculpture()->active()->limit( 20 )->get();

		return view( 'sculpture.index', compact( 'sculptures' ) );
	}

	public function artwork( $id ) {

		$artwork = Artwork::find( $id );

		return view( 'artwork.show', compact( 'artwork' ) );
	}

	public function shoppingCart() {

		$oldCart = session( 'cart' );
		$cart    = new Cart( $oldCart );

		return view( 'checkout.shopping-cart', with( [
			'artworks'   => $cart->items,
			'totalPrice' => $cart->totalPrice
		] ) );
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

		return $artworks;

		return view( 'search', compact( 'artworks', 'artists' ) );
	}

}



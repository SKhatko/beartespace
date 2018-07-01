<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Cart;
use App\Contact_query;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class HomeController extends Controller {

	public function index() {
		// Home page

		return view( 'index' );
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

	public function paintings() {
		$paintings = Artwork::painting()->active()->limit( 20 )->get();

		return view( 'painting.index', compact( 'paintings' ) );
	}

	public function sculptures() {
		$sculptures = Artwork::sculpture()->active()->limit( 20 )->get();

		return view( 'sculpture.index', compact( 'sculptures' ) );
	}

	public function artwork( $id ) {

		$artwork = Artwork::find( $id );

		return view( $artwork->category . '.show', compact( 'artwork' ) );
	}

	public function shoppingCart() {

		$oldCart = session('cart');
		$cart = new Cart($oldCart);

		return view('checkout.shopping-cart', with(['artworks' => $cart->items, 'totalPrice' => $cart->totalPrice]));
	}

	public function checkout() {
		return view( 'checkout.index' );
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

	public function contactMessages() {
		$title = trans( 'app.contact_messages' );

		return view( 'admin.contact_messages', compact( 'title' ) );
	}

	public function contactMessagesData() {
		$contact_messages = Contact_query::select( 'name', 'email', 'message', 'created_at' )->orderBy( 'id', 'desc' )->get();

		return Datatables::of( $contact_messages )
		                 ->editColumn( 'created_at', function ( $contact_message ) {
			                 return $contact_message->created_at_datetime();
		                 } )
		                 ->make();
	}
}



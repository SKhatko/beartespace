<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Category;
use App\Contact_query;
use App\Slider;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\Page;

class HomeController extends Controller {

	public function index() {

		// Home page

		$artworks = Artwork::all();

//		return $artworks;

		return view( 'index', compact( 'artworks' ) );
	}

	public function contacts() {
		$title = trans( 'app.contact_us' );

		return view( 'pages.contacts', compact( 'title' ) );
	}

	public function contactsPost( Request $request ) {
		$rules = [
			'name'    => 'required',
			'email'   => 'required|email',
			'message' => 'required',
		];
		$this->validate( $request, $rules );
		Contact_query::create( array_only( $request->input(), [ 'name', 'email', 'message' ] ) );

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


	public function auctions() {

		$auctions = Artwork::all();

		return view( 'auctions.index', compact( 'auctions' ) );
	}

	public function artists() {

		$artists = User::all();

		return view( 'artists.index', compact( 'artists' ) );
	}

	public function paintings() {
		$paintings = Artwork::all();

		return view( 'paintings.index', compact( 'paintings' ) );
	}

	public function sculptures() {
		$sculptures = Artwork::all();

		return view( 'sculptures.index', compact( 'sculptures' ) );
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

}

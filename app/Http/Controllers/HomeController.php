<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use App\Contact_query;
use App\Slider;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables\Datatables;

class HomeController extends Controller {

	public function index() {
		$top_categories = Category::whereCategoryType( 'auction' )->orderBy( 'category_name', 'asc' )->get();

		$limit_regular_ads = get_option( 'number_of_free_ads_in_home' );
		$limit_premium_ads = get_option( 'number_of_premium_ads_in_home' );

		$regular_ads = Ad::activeRegular()->with( 'category', 'city' )->limit( $limit_regular_ads )->orderBy( 'id', 'desc' )->get();
		$premium_ads = Ad::activePremium()->with( 'category', 'city' )->limit( $limit_premium_ads )->orderBy( 'id', 'desc' )->get();

		$total_ads_count = Ad::active()->count();
		$user_count      = User::count();

		return view( 'index', compact( 'top_categories', 'regular_ads', 'premium_ads', 'total_ads_count', 'user_count' ) );
	}

	public function contactUs() {
		$title = trans( 'app.contact_us' );

		return view( 'pages.contact_us', compact( 'title' ) );
	}

	public function contactUsPost( Request $request ) {
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

}

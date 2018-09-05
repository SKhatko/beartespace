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
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$title = trans( 'portal.users' );

		$users = User::all();

		return view( 'dashboard.admin.users', compact( 'title', 'users' ) );
	}

	public function profile() {

		$title = trans( 'portal.profile' );

		$user = auth()->user();

//		->each(function ($media) use $user {
//			$user->avatar()->associate(factory(Media::class)->create());
//		});
//		return $user;

		return view( 'dashboard.user.profile', compact( 'title', 'user' ) );
	}

	public function favoriteArtworks() {

		$user = auth()->user();

		$artworks = $user->favouriteArtworks()->orderBy( 'id', 'desc' )->get();

		return view( 'dashboard.user.favourites', compact( 'artworks' ) );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$countries = Countries::all();

		return view( 'theme.user_create', compact( 'countries' ) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$rules = [
			'first_name'            => 'required',
			'email'                 => 'required|email',
			'gender'                => 'required',
			'country'               => 'required',
			'password'              => 'required|confirmed',
			'password_confirmation' => 'required',
			'phone'                 => 'required',
			'agree'                 => 'required',
		];
		$this->validate( $request, $rules );

		$active_status = get_option( 'verification_email_after_registration' );

		$data = [
			'first_name' => $request->first_name,
			'last_name'  => $request->last_name,
			'name'       => $request->first_name . ' ' . $request->last_name,
			'email'      => $request->email,
			'password'   => bcrypt( $request->password ),
			'phone'      => $request->phone,
			'gender'     => $request->gender,
			'country_id' => $request->country,

			'user_type'     => 'user',
			'active_status' => ( $active_status == '1' ) ? '0' : '1',
		];

		$user_create = User::create( $data );

		if ( $user_create ) {
			$registration_success_activating_msg = "";
			if ( $active_status == '1' ) {
				try {
					$registration_success_activating_msg = ", we've sent you an activation email, please follow email instruction";

					Mail::send( 'emails.activation_email', [ 'user' => $data ], function ( $m ) use ( $data ) {
						$m->from( get_option( 'email_address' ), get_option( 'site_name' ) );
						$m->to( $data['email'], $data['name'] )->subject( trans( 'app.activate_email_subject' ) );
					} );
				} catch ( \Exception $e ) {
					$registration_success_activating_msg = ", we can't sending you activation email during an email error, please contact with your admin";
					//
				}
			}

			return redirect( route( 'login' ) )->with( 'registration_success', trans( 'app.registration_success' ) . $registration_success_activating_msg );
		} else {
			return back()->withInput()->with( 'error', trans( 'app.error_msg' ) );
		}
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
		//
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

	public function changePassword() {
		$title = trans( 'portal.change_password' );

		return view( 'dashboard.user.change-password', compact( 'title' ) );
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

				return redirect()->back()->with( ['message' => ['message' => 'Password changed successfully'] ]);
			}

			return redirect()->back()->with( 'error', 'Wrong Old password' );
		}

	}
}

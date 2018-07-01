<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Brand;
use App\CarsVehicle;
use App\Cart;
use App\Category;
use App\City;
use App\Comment;
use App\Country;
use App\Job;
use App\JobApplication;
use App\Media;
use App\Payment;
use App\ArtworkReport;
use App\State;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ArtworkController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$title = 'My artworks';

		$user = Auth::user();

		$artworks = $user->artworks()->orderBy( 'id', 'desc' )->get();

		return view( 'dashboard.artworks.index', compact( 'title', 'artworks' ) );
	}

	public function addToCart( Request $request, $id ) {

		$artwork = Artwork::find( $id );

		$oldCart = session( 'cart' );

		$cart = new Cart( $oldCart );

		$cart->add( $artwork, $artwork->id );

		session( [ 'cart' => $cart ] );

		return redirect()->route( 'shopping-cart' );
	}

	public function removeFromCart(Request $request, $id) {

		$artwork = Artwork::find( $id );

		$oldCart = session( 'cart' );

		$cart = new Cart( $oldCart );

		$cart->remove( $artwork, $artwork->id );

		session( [ 'cart' => $cart ] );

		return redirect()->route( 'shopping-cart' );
	}

	public function adminPendingAds() {
		$title = trans( 'app.pending_ads' );
		$ads   = Artwork::with( 'city', 'country', 'state' )->whereStatus( '0' )->orderBy( 'id', 'desc' )->paginate( 20 );

		return view( 'admin.all_ads', compact( 'title', 'ads' ) );
	}

	public function adminBlockedAds() {
		$title = trans( 'app.blocked_ads' );
		$ads   = Artwork::with( 'city', 'country', 'state' )->whereStatus( '2' )->orderBy( 'id', 'desc' )->paginate( 20 );

		return view( 'admin.all_ads', compact( 'title', 'ads' ) );
	}

	public function pendingAds() {
		$title = trans( 'app.my_ads' );

		$user = Auth::user();
		$ads  = $user->ads()->whereStatus( '0' )->with( 'city', 'country', 'state' )->orderBy( 'id', 'desc' )->paginate( 20 );

		return view( 'admin.pending_ads', compact( 'title', 'ads' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$title = 'Upload New Artwork';

		return view( 'dashboard.artworks.create', compact( 'title' ) );
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

		$title = 'Edit Artwork';

		$artwork = Artwork::find( $id );
		$user    = auth()->user();

		if ( $artwork->user_id === $user->id || $user->isAdmin() ) {
			return view( 'dashboard.artworks.edit', compact( 'title', 'artwork' ) );
		} else {
			return redirect( route( 'dashboard' ) )->with( 'error', trans( 'app.access_restricted' ) );
		}

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

	}


	public function adStatusChange( Request $request ) {
		$slug = $request->slug;
		$ad   = Artwork::whereSlug( $slug )->first();
		if ( $ad ) {
			$value = $request->value;

			$ad->status = $value;
			$ad->save();

			if ( $value == 1 ) {
				return [ 'success' => 1, 'msg' => trans( 'app.ad_approved_msg' ) ];
			} elseif ( $value == 2 ) {
				return [ 'success' => 1, 'msg' => trans( 'app.ad_blocked_msg' ) ];
			} elseif ( $value == 3 ) {
				return [ 'success' => 1, 'msg' => trans( 'app.ad_archived_msg' ) ];
			}
		}

		return [ 'success' => 0, 'msg' => trans( 'app.error_msg' ) ];

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( Request $request, $id ) {
		$artwork = Artwork::find( $id );

		$artwork->images()->delete();
		$artwork->delete();

	}

	public function uploadAdsImage( Request $request, $ad_id = 0 ) {
		$user_id = 0;

		if ( Auth::check() ) {
			$user_id = Auth::user()->id;
		}

		if ( $request->hasFile( 'images' ) ) {
			$images = $request->file( 'images' );
			foreach ( $images as $image ) {
				$valid_extensions = [ 'jpg', 'jpeg', 'png' ];
				if ( ! in_array( strtolower( $image->getClientOriginalExtension() ), $valid_extensions ) ) {
					return redirect()->back()->withInput( $request->input() )->with( 'error', 'Only .jpg, .jpeg and .png is allowed extension' );
				}

				$file_base_name = str_replace( '.' . $image->getClientOriginalExtension(), '', $image->getClientOriginalName() );
				$resized        = Image::make( $image )->resize( 640, null, function ( $constraint ) {
					$constraint->aspectRatio();
				} )->stream();
				$resized_thumb  = Image::make( $image )->resize( 320, 213 )->stream();

				$image_name = strtolower( time() . str_random( 5 ) . '-' . str_slug( $file_base_name ) ) . '.' . $image->getClientOriginalExtension();

				$imageFileName  = 'uploads/images/' . $image_name;
				$imageThumbName = 'uploads/images/thumbs/' . $image_name;

				try {
					//Upload original image
					$is_uploaded = current_disk()->put( $imageFileName, $resized->__toString(), 'public' );

					if ( $is_uploaded ) {
						//Save image name into db
						$created_img_db = Media::create( [ 'user_id'    => $user_id,
						                                   'ad_id'      => $ad_id,
						                                   'media_name' => $image_name,
						                                   'type'       => 'image',
						                                   'storage'    => get_option( 'default_storage' ),
						                                   'ref'        => 'ad'
						] );

						//upload thumb image
						current_disk()->put( $imageThumbName, $resized_thumb->__toString(), 'public' );
						$img_url = media_url( $created_img_db, false );
					}
				} catch ( \Exception $e ) {
					return redirect()->back()->withInput( $request->input() )->with( 'error', $e->getMessage() );
				}
			}
		}
	}

	/**
	 * @param Request $request
	 *
	 * @return array
	 */

	public function deleteMedia( Request $request ) {
		$media_id = $request->media_id;
		$media    = Media::find( $media_id );

		$storage = Storage::disk( $media->storage );
		if ( $storage->has( 'uploads/images/' . $media->media_name ) ) {
			$storage->delete( 'uploads/images/' . $media->media_name );
		}

		if ( $media->type == 'image' ) {
			if ( $storage->has( 'uploads/images/thumbs/' . $media->media_name ) ) {
				$storage->delete( 'uploads/images/thumbs/' . $media->media_name );
			}
		}

		$media->delete();

		return [ 'success' => 1, 'msg' => trans( 'app.media_deleted_msg' ) ];
	}

	/**
	 * @param Request $request
	 *
	 * @return array
	 */
	public function reportAds( Request $request ) {
		$ad = Artwork::whereSlug( $request->slug )->first();
		if ( $ad ) {
			$data = [
				'ad_id'   => $ad->id,
				'reason'  => $request->reason,
				'email'   => $request->email,
				'message' => $request->message,
			];
			ArtworkReport::create( $data );

			return [ 'status' => 1, 'msg' => trans( 'app.ad_reported_msg' ) ];
		}

		return [ 'status' => 0, 'msg' => trans( 'app.error_msg' ) ];
	}


	public function reports() {
		$reports = Report_Artwork::orderBy( 'id', 'desc' )->with( 'ad' )->paginate( 20 );
		$title   = trans( 'app.ad_reports' );

		return view( 'admin.ad_reports', compact( 'title', 'reports' ) );
	}

	public function deleteReports( Request $request ) {
		ArtworkReport::find( $request->id )->delete();

		return [ 'success' => 1, 'msg' => trans( 'app.report_deleted_success' ) ];
	}

	public function reportsByAds( $slug ) {
		$user = Auth::user();

		if ( $user->isAdmin() ) {
			$ad = Artwork::whereSlug( $slug )->first();
		} else {
			$ad = Artwork::whereSlug( $slug )->whereUserId( $user->id )->first();
		}

		if ( ! $ad ) {
			return view( 'admin.error.error_404' );
		}

		$reports = $ad->reports()->paginate( 20 );

		$title = trans( 'app.ad_reports' );

		return view( 'admin.reports_by_ads', compact( 'title', 'ad', 'reports' ) );
	}

}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group( [ 'middleware' => 'web' ], function () {

	Auth::routes();

	Route::get( 'confirm-email/activate/{token}', 'Auth\ConfirmEmailController@confirm' )->name( 'confirm-email.activate' );
	Route::get( 'confirm-email/verify', 'Auth\ConfirmEmailController@verify' )->name( 'confirm-email.verify' );
	Route::get( 'confirm-email/resend', 'Auth\ConfirmEmailController@resend' )->name( 'confirm-email.resend' );

	Route::group( [ 'prefix' => 'login' ], function () {
		//Social login route
		Route::get( 'facebook', 'SocialLogin@redirectFacebook' )->name( 'facebook_redirect' );
		Route::get( 'facebook-callback', 'SocialLogin@callbackFacebook' )->name( 'facebook_callback' );

		Route::get( 'google', 'SocialLogin@redirectGoogle' )->name( 'google_redirect' );
		Route::get( 'google-callback', 'SocialLogin@callbackGoogle' )->name( 'google_callback' );

		Route::get( 'twitter', 'SocialLogin@redirectTwitter' )->name( 'twitter_redirect' );
		Route::get( 'twitter-callback', 'SocialLogin@callbackTwitter' )->name( 'twitter_callback' );
	} );


	Route::get( '/', 'HomeController@index' )->name( 'home' );
	Route::get( '/auction', 'HomeController@auctions' )->name( 'auctions' );
	Route::get( '/auction/{id}', 'HomeController@auctions' )->name( 'auction' );
	Route::get( '/artwork', 'HomeController@artworks' )->name( 'artworks' );
	Route::get( '/artwork/{id}', 'HomeController@artwork' )->name( 'artwork' );
	Route::get( '/artist', 'HomeController@artists' )->name( 'artists' );
	Route::get( '/artist/{id}', 'HomeController@artist' )->name( 'artist' );

	// Contact us page
	Route::get( 'contact-form', 'HomeController@contactForm' )->name( 'contact-form' );
	Route::post( 'contact-form', 'HomeController@contactFormPost' )->name( 'contact-form' );

	// Search
	Route::post( 'search/{query?}', 'HomeController@search' )->name( 'search' );

	// Leads
	Route::post( 'add-lead', 'LeadController@addLead' )->name( 'add-lead' );

	Route::get( '/language/{lang}', [ 'as' => 'switch_language', 'uses' => 'LanguageController@switchLang' ] );

	// Shopping
	Route::get( 'shopping-cart', 'HomeController@shoppingCart' )->name( 'shopping-cart' );
	Route::get( 'add-to-cart/{id}', 'ArtworkController@addToCart' )->name( 'add-to-cart' );
	Route::get( 'toggle-to-cart/{id}', 'ArtworkController@toggleToCart' )->name( 'toggle-to-cart' );
	Route::get( 'remove-from-cart/{id}', 'ArtworkController@removeFromCart' )->name( 'remove-from-cart' );
	Route::get( 'checkout', 'HomeController@checkout' )->name( 'checkout' );


// Pages
	Route::get( 'about', 'HomeController@about' )->name( 'about' );
	Route::get( 'rules', 'HomeController@rules' )->name( 'rules' );
	Route::get( 'shipping', 'HomeController@shipping' )->name( 'shipping' );

//Dashboard Route
	Route::group( [ 'prefix' => 'dashboard', 'middleware' => [ 'dashboard', 'confirmed-email' ] ], function () {

		// All users access
		Route::get( '/', 'DashboardController@dashboard' )->name( 'dashboard' );
		Route::get( 'profile', 'UserController@profile' )->name( 'dashboard.profile' );
		Route::get( 'change-password', 'UserController@changePassword' )->name( 'dashboard.change-password' );
		Route::post( 'change-password', 'UserController@changePasswordPost' );

		// TODO
		Route::get( 'payments', 'PaymentController@index' )->name( 'dashboard.payments' );


		Route::get( 'favorites', 'UserController@favoriteArtworks' )->name( 'dashboard.favorites' );


		// Not user (admin, artist, gallery)
		Route::group( [ 'middleware' => 'artist' ], function () {

			Route::get( 'artworks', 'ArtworkController@index' )->name( 'dashboard.artworks' );
			Route::get( 'artwork/create', 'ArtworkController@create' )->name( 'dashboard.artwork.create' );
			Route::get( 'artwork/{id}/edit', 'ArtworkController@edit' )->name( 'dashboard.artwork.edit' );
			Route::post( 'artwork/{id}', 'ArtworkController@destroy' )->name( 'dashboard.artwork.destroy' );
		} );


		// Admin only

		Route::group( [ 'middleware' => 'admin' ], function () {

			Route::get( 'users', 'UserController@index' )->name( 'admin.users' );
			Route::get( 'translations', 'TranslationController@index' )->name( 'admin.translations' );
			Route::get( 'languages', 'LanguageController@index' )->name( 'admin.languages' );
			Route::get( 'pages', 'PageController@index' )->name( 'admin.pages' );
			Route::get( 'messages', 'MessageController@messages' )->name( 'admin.messages' );


			Route::get( 'approved', [ 'as' => 'approved_ads', 'uses' => 'ArtworkController@index' ] );
			Route::get( 'pending', [ 'as' => 'admin_pending_ads', 'uses' => 'ArtworkController@adminPendingArtworks' ] );
			Route::get( 'blocked', [ 'as' => 'admin_blocked_ads', 'uses' => 'ArtworkController@adminBlockedArtworks' ] );
			Route::post( 'status-change', [
				'as'   => 'ads_status_change',
				'uses' => 'ArtworkController@artworkStatusChange'
			] );

			Route::post( 'change-user-feature', [
				'as'   => 'change_user_feature',
				'uses' => 'UserController@changeFeature'
			] );

		} );

		Route::group( [ 'prefix' => 'u' ], function () {
			Route::group( [ 'prefix' => 'posts' ], function () {
				Route::post( 'delete', [ 'as' => 'delete_ads', 'uses' => 'ArtworkController@destroy' ] );
				Route::get( 'edit/{id}', [ 'as' => 'edit_ad', 'uses' => 'ArtworkController@edit' ] );
				Route::post( 'edit/{id}', [ 'uses' => 'ArtworkController@update' ] );
				Route::get( 'my-lists', [ 'as' => 'my_ads', 'uses' => 'ArtworkController@myAds' ] );
				//Upload ads image


				//Delete media
				Route::post( 'feature-media-creating', [
					'as'   => 'feature_media_creating_ads',
					'uses' => 'ArtworkController@featureMediaCreatingAds'
				] );
				Route::get( 'append-media-image', [
					'as'   => 'append_media_image',
					'uses' => 'ArtworkController@appendMediaImage'
				] );

				Route::get( 'pending-lists', [ 'as' => 'pending_ads', 'uses' => 'ArtworkController@pendingArtworks' ] );
				Route::get( 'archive-lists', [ 'as' => 'favourite_ad', 'uses' => 'ArtworkController@create' ] );

				//bids
				Route::get( 'bids/{ad_id}', [ 'as' => 'auction_bids', 'uses' => 'BidController@index' ] );
				Route::post( 'bids/action', [ 'as' => 'bid_action', 'uses' => 'BidController@bidAction' ] );
				Route::get( 'bidder_info/{bid_id}', [ 'as' => 'bidder_info', 'uses' => 'BidController@bidderInfo' ] );
			} );
		} );

	} );

} );




Route::get( 'auction-by-user/{id?}', [ 'as' => 'ads_by_user', 'uses' => 'ArtworkController@adsByUser' ] );

Route::get( 'auction/{id}/{slug?}', [ 'as' => 'single_ad', 'uses' => 'ArtworkController@singleAuction' ] );
Route::get( 'embedded/{slug}', [ 'as' => 'embedded_ad', 'uses' => 'ArtworkController@embeddedAd' ] );

Route::post( 'save-ad-as-favorite', [ 'as' => 'save_ad_as_favorite', 'uses' => 'UserController@saveAdAsFavorite' ] );
Route::post( 'report-post', [ 'as' => 'report_ads_pos', 'uses' => 'ArtworkController@reportAds' ] );
Route::post( 'reply-by-email', [ 'as' => 'reply_by_email_post', 'uses' => 'UserController@replyByEmailPost' ] );
Route::post( 'post-comments/{id}', [ 'as' => 'post_comments', 'uses' => 'CommentController@postComments' ] );


Route::get( 'apply_job', function () {
	return redirect( route( 'home' ) );
} );

// Password reset routes...
//Route::post('send-password-reset-link', ['as' => 'send_reset_link', 'uses'=>'Auth\PasswordController@postEmail']);
//Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
//Route::post('password/reset', ['as'=>'password_reset_post', 'uses'=>'Auth\PasswordController@postReset']);

Route::post( 'get-sub-category-by-category', [
	'as'   => 'get_sub_category_by_category',
	'uses' => 'ArtworkController@getSubCategoryByCategory'
] );
Route::post( 'get-brand-by-category', [
	'as'   => 'get_brand_by_category',
	'uses' => 'ArtworkController@getBrandByCategory'
] );
Route::post( 'get-category-info', [
	'as'   => 'get_category_info',
	'uses' => 'ArtworkController@getParentCategoryInfo'
] );
Route::post( 'get-state-by-country', [
	'as'   => 'get_state_by_country',
	'uses' => 'ArtworkController@getStateByCountry'
] );
Route::post( 'get-city-by-state', [ 'as' => 'get_city_by_state', 'uses' => 'ArtworkController@getCityByState' ] );
Route::post( 'switch/product-view', [
	'as'   => 'switch_grid_list_view',
	'uses' => 'ArtworkController@switchGridListView'
] );


//Post bid
Route::post( '{id}/post-new', [ 'as' => 'post_bid', 'uses' => 'BidController@postBid' ] );


//Checkout payment
Route::get( 'checkout/{transaction_id}', [ 'as' => 'payment_checkout', 'uses' => 'PaymentController@checkout' ] );
Route::post( 'checkout/{transaction_id}', [ 'uses' => 'PaymentController@chargePayment' ] );
//Payment success url
Route::any( 'checkout/{transaction_id}/payment-success', [
	'as'   => 'payment_success_url',
	'uses' => 'PaymentController@paymentSuccess'
] );
Route::any( 'checkout/{transaction_id}/paypal-notify', [
	'as'   => 'paypal_notify_url',
	'uses' => 'PaymentController@paypalNotify'
] );


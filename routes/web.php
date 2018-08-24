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
	Route::get( 'confirm-email/verify', 'Auth\ConfirmEmailController@verify' )->name( 'confirm-email.verify' )->middleware( 'auth' );
	Route::get( 'confirm-email/resend', 'Auth\ConfirmEmailController@resend' )->name( 'confirm-email.resend' )->middleware( 'auth' );

	Route::get( 'subscription/update', 'SubscriptionController@updatePlan' )->name( 'subscription.update' )->middleware( 'auth' );
	Route::post( 'subscription/stripe', 'SubscriptionController@payWithStripe' )->name( 'subscription.stripe' )->middleware( 'auth' );

	// Search
	Route::get( 'search/{query?}', 'HomeController@search' )->name( 'search' )->middleware( 'auth' );

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
	Route::get( '/home', 'HomeController@index' );
	Route::get( '/auction', 'HomeController@auctions' )->name( 'auctions' );
	Route::get( '/auction/{id}', 'HomeController@auctions' )->name( 'auction' );
	Route::get( '/artwork', 'HomeController@artworks' )->name( 'artworks' );
	Route::get( '/artwork/{id}', 'HomeController@artwork' )->name( 'artwork' );
	Route::get( '/artist', 'HomeController@artists' )->name( 'artists' );
	Route::get( '/artist/{id}', 'HomeController@artist' )->name( 'artist' );
	Route::get( '/selection/artist', 'HomeController@selectedArtists')->name('selected-artists');
	Route::get( '/selection/artwork', 'HomeController@selectedArtworks')->name('selected-artworks');

	// Invites
	Route::get( '/invite/artist', 'HomeController@inviteArtist' )->name( 'invite.artist' );
	Route::get( '/invite/gallery', 'HomeController@inviteGallery' )->name( 'invite.gallery' );
	Route::get( '/invite/writer', 'HomeController@inviteWriter' )->name( 'invite.writer' );
	Route::get( '/invite/customer', 'HomeController@inviteCustomer' )->name( 'invite.customer' );
	// Contact us page
	Route::get( 'contact-form', 'HomeController@contactForm' )->name( 'contact-form' );
	Route::post( 'contact-form', 'HomeController@contactFormPost' )->name( 'contact-form' );

	// Leads
	Route::post( 'add-lead', 'LeadController@addLead' )->name( 'add-lead' );

	// Page
	Route::get( 'page/{slug}', 'PageController@show' )->name( 'page' );

	Route::get( 'language/{lang}', 'LanguageController@switchLang' )->name( 'switch-language' );
	Route::get( 'currency/{code}', 'CurrencyController@switchCurrency' )->name( 'switch-currency' );

	// Shopping
	Route::get( 'shopping-cart', 'CartController@index' )->name( 'shopping-cart' );
	Route::get( 'add-to-cart/{id}', 'CartController@addToCart' )->name( 'add-to-cart' );
	Route::get( 'toggle-to-cart/{id}', 'CartController@toggleToCart' )->name( 'toggle-to-cart' );
	Route::get( 'remove-from-cart/{id}', 'CartController@removeFromCart' )->name( 'remove-from-cart' );
	Route::get( 'checkout', 'HomeController@checkout' )->name( 'checkout' );

	// Pages
	Route::get( 'about', 'HomeController@about' )->name( 'about' );
	Route::get( 'rules', 'HomeController@rules' )->name( 'rules' );
	Route::get( 'shipping', 'HomeController@shipping' )->name( 'shipping' );


	//Dashboard Route
	Route::group( [
		'prefix'     => 'dashboard',
		'middleware' => [
			'auth',
			'dashboard',
			'confirmed-email',
			'has-profile-avatar',
		]
	], function () {

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
			Route::get( 'messages', 'MessageController@index' )->name( 'admin.messages' );
			Route::get( 'settings', 'SettingController@index' )->name( 'admin.settings' );


			Route::get( 'approved', [ 'as' => 'approved_ads', 'uses' => 'ArtworkController@index' ] );
			Route::get( 'pending', [
				'as'   => 'admin_pending_ads',
				'uses' => 'ArtworkController@adminPendingArtworks'
			] );
			Route::get( 'blocked', [
				'as'   => 'admin_blocked_ads',
				'uses' => 'ArtworkController@adminBlockedArtworks'
			] );

		} );

		Route::group( [ 'prefix' => 'u' ], function () {
			Route::group( [ 'prefix' => 'posts' ], function () {

				Route::get( 'pending-lists', [ 'as' => 'pending_ads', 'uses' => 'ArtworkController@pendingArtworks' ] );
				Route::get( 'archive-lists', [ 'as' => 'favourite_ad', 'uses' => 'ArtworkController@create' ] );

				//bids
				Route::get( 'bids/{ad_id}', [ 'as' => 'auction_bids', 'uses' => 'BidController@index' ] );
				Route::post( 'bids/action', [ 'as' => 'bid_action', 'uses' => 'BidController@bidAction' ] );
				Route::get( 'bidder_info/{bid_id}', [ 'as' => 'bidder_info', 'uses' => 'BidController@bidderInfo' ] );
			} );
		} );

	} );

	// Global artist profile search
	Route::get( '{artist}', 'HomeController@artistProfile' )->name( 'artist-profile' );


} );

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


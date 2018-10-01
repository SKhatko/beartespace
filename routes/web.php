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
	Route::get( 'search/{query?}', 'HomeController@search' )->name( 'search' );

	Route::group( [ 'prefix' => 'login' ], function () {
		//Social login route
		Route::get( 'facebook', 'SocialLogin@redirectFacebook' )->name( 'facebook-redirect' );
		Route::get( 'facebook-callback', 'SocialLogin@callbackFacebook' );

		Route::get( 'google', 'SocialLogin@redirectGoogle' )->name( 'google-redirect' );
		Route::get( 'google-callback', 'SocialLogin@callbackGoogle' );

		Route::get( 'twitter', 'SocialLogin@redirectTwitter' )->name( 'twitter-redirect' );
		Route::get( 'twitter-callback', 'SocialLogin@callbackTwitter' );
	} );


	Route::get( '/', 'HomeController@index' )->name( 'home' );
	Route::get( '/home', 'HomeController@index' );
	Route::get( '/auction', 'AuctionController@index' )->name( 'auctions' );
	Route::get( '/auction/{id}', 'AuctionController@show' )->name( 'auction' );
	Route::get( '/artwork', 'HomeController@artworks' )->name( 'artworks' );
	Route::get( '/artwork/{id}', 'HomeController@artwork' )->name( 'artwork' );
	Route::get( '/artist', 'HomeController@artists' )->name( 'artists' );
	Route::get( '/artist/{id}', 'HomeController@artist' )->name( 'artist' );
	Route::get( '/selection/artist', 'HomeController@selectedArtists' )->name( 'selected-artists' );
	Route::get( '/selection/artwork', 'HomeController@selectedArtworks' )->name( 'selected-artworks' );

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

	// Shopping Cart
	Route::get( 'cart', 'CartController@index' )->name( 'cart' );
	Route::get( 'cart/item/{id}/toggle', 'CartController@apiToggleCart' );
	Route::get( 'cart/item/{id}/buy-now', 'CartController@buyNow' )->name( 'cart.item.buy-now' );
	Route::get( 'cart/item/{id}/add', 'CartController@addItem' )->name( 'cart.item.add' );
	Route::get( 'cart/item/{id}/remove', 'CartController@removeItem' )->name( 'cart.item.remove' );

	// Checkout
	Route::middleware( [ 'auth', 'shopping-cart', 'has-primary-address' ] )->group( function () {
		Route::get( 'checkout', 'CheckoutController@index' )->name( 'checkout' );
		Route::get( 'checkout/{transaction_id}', 'PaymentController@checkout' );
	} );

	// Address
	Route::get( 'address', 'AddressController@index' )->middleware( 'auth' )->name( 'address' );
	Route::post( 'address/{id}', 'AddressController@setPrimaryAddress' )->middleware( 'auth' );

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

		Route::get( 'order', 'OrderController@index' )->name( 'dashboard.orders' );

		Route::get( 'favorite/{id}/toggle', 'FavoriteController@toggleFavoriteArtwork' )->name( 'favorite.toggle' )->middleware( 'auth' );
		Route::get( 'favorites', 'UserController@favoriteArtworks' )->name( 'dashboard.favorites' );

		// Not user (admin, artist, gallery)
		Route::group( [ 'middleware' => 'artist' ], function () {
			Route::get( 'artwork', 'ArtworkController@index' )->name( 'dashboard.artworks' );
			Route::get( 'artwork/create', 'ArtworkController@create' )->name( 'dashboard.artwork.create' );
			Route::get( 'artwork/{id}/edit', 'ArtworkController@edit' )->name( 'dashboard.artwork.edit' );
		} );

		// Admin only
		Route::group( [ 'middleware' => 'admin' ], function () {

			Route::get( 'payments', 'PaymentController@index' )->name( 'admin.payments' );
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
Route::post( 'checkout/{transaction_id?}', [ 'uses' => 'PaymentController@chargePayment' ] );
//Payment success url
Route::any( 'checkout/{transaction_id}/payment-success', [
	'as'   => 'payment_success_url',
	'uses' => 'PaymentController@paymentSuccess'
] );
Route::any( 'checkout/{transaction_id}/paypal-notify', [
	'as'   => 'paypal_notify_url',
	'uses' => 'PaymentController@paypalNotify'
] );


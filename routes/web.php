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

/* List of used routes
confirm-email
subscription
search
login
home
auction
artwork
article
artist
contact-form
lead
page
language
currency
cart
checkout
address
about
rules
shipping
dashboard

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
	Route::get( '/sell', 'HomeController@sell' );

	Route::get( '/auction', 'AuctionController@index' )->name( 'auctions' );
	Route::get( '/auction/{id}', 'AuctionController@show' )->name( 'auction' );
	Route::get( '/artwork', 'ArtworkController@artworks' )->name( 'artworks' );
	Route::get( '/artwork/{id}', 'ArtworkController@artwork' )->name( 'artwork' );
	Route::get( '/artist', 'UserController@artists' )->name( 'artists' );
	Route::get( '/artist/{id}', 'UserController@artist' )->name( 'artist' );
	Route::get( '/article', 'ArticleController@index' )->name( 'articles' );
	Route::get( '/article/{id}', 'ArticleController@show' )->name( 'article' );
	Route::get( '/selection/artist', 'HomeController@selectedArtists' )->name( 'selected-artists' );
	Route::get( '/selection/artwork', 'HomeController@selectedArtworks' )->name( 'selected-artworks' );

	// Contact us page
	Route::get( 'contact-form', 'HomeController@contactForm' )->name( 'contact-form' );
	Route::post( 'contact-form', 'HomeController@contactFormPost' )->name( 'contact-form' );

	// Leads
	Route::post( 'lead/add-lead', 'LeadController@addLead' )->name( 'add-lead' );

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

	// Shipping
	Route::get( 'cart/shipping', 'CartCheckoutController@shipping' )->middleware( ['auth','has-shopping-cart'] )->name( 'cart.shipping' );
	Route::post( 'cart/shipping/{id}', 'CartCheckoutController@setPrimaryShippingAddress' )->middleware( 'auth', 'has-shopping-cart' );

	// Cart Checkout
	Route::middleware( [ 'auth', 'has-shopping-cart', 'has-primary-address' ] )->group( function () {
//		Route::get( 'checkout/{transaction_id}', 'PaymentController@checkout' );
		Route::get('cart/payment', 'CartCheckoutController@payment')->name('cart.payment');
		Route::post( 'cart/payment', 'CartCheckoutController@savePaymentMethod' );
		Route::get( 'cart/checkout', 'CartCheckoutController@checkout' )->name( 'cart.checkout' )->middleware('has-payment-method');
		Route::post( 'cart/checkout', 'CartCheckoutController@checkoutPost' )->middleware('has-payment-method');
	} );

	Route::get('cart/checkout/success', 'CartCheckoutController@checkoutSuccess')->name('cart.checkout.success')->middleware('auth');
	Route::get('cart/checkout/failure', 'CartCheckoutController@checkoutSuccess')->name('cart.checkout.failure')->middleware('auth');

	// Pages
	Route::get( 'about', 'HomeController@about' )->name( 'about' );
	Route::get( 'rules', 'HomeController@rules' )->name( 'rules' );
	Route::get( 'shipping', 'HomeController@shipping' )->name( 'shipping' );

	//Dashboard Route
	Route::group( [
		'prefix'     => 'dashboard',
		'middleware' => [
			'auth',
			'confirmed-email',
		]
	], function () {

		// All users access
		Route::get( '/', 'DashboardController@dashboard' )->name( 'dashboard' );
		Route::get( 'profile', 'UserController@profile' )->name( 'dashboard.profile' );
		Route::post( 'change-password', 'UserController@changePasswordPost' )->name( 'dashboard.change-password' );

		Route::get( 'account', 'UserController@accountSettings')->name('dashboard.account');
		Route::get( 'order', 'UserController@orders' )->name( 'dashboard.orders' );

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
		} );

		Route::group( [ 'prefix' => 'u' ], function () {
			Route::group( [ 'prefix' => 'posts' ], function () {

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



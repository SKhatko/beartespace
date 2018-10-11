<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group( [ 'middleware' => 'auth:api' ], function () {
	Route::get( 'profile', 'Api\UserController@show' );

	Route::post( 'settings', 'Api\SettingController@update' );
	Route::post( 'translations', 'Api\TranslationController@update' );
	Route::post( 'languages', 'Api\LanguageController@store' );
	Route::post( 'profile', 'Api\UserController@update' );
	Route::post( 'pages', 'Api\PageController@store' );
	Route::post( 'article', 'Api\ArticleController@store' );
	Route::post( 'article/{id}', 'Api\ArticleController@update' );

	Route::put( 'user/favorite/{id}/toggle', 'Api\UserController@toggleFavoriteArtwork' );
	Route::put( 'user/followed/{id}/toggle', 'Api\UserController@toggleFollowedUser' );

	Route::get( 'user/check-username/{username}', 'Api\UserController@checkUsername' );
	Route::post( 'user', 'Api\UserController@destroy' )->middleware( 'admin' );


	// Upload files
	Route::any( 'user/upload-user-avatar', 'Api\UserController@uploadUserAvatar' );
	Route::any( 'user/upload-user-image', 'Api\UserController@uploadUserImage' );

	// Artwork
	Route::post( 'artwork', 'Api\ArtworkController@store' );
	Route::post( 'artwork/upload-artwork-image', 'Api\ArtworkController@uploadArtworkImage' );
	Route::post( 'artwork/upload-artwork-images', 'Api\ArtworkController@uploadArtworkImages' );

	// Change email
	Route::post( 'change-email', 'Auth\ConfirmEmailController@changeEmail' );

	// Checkout
	Route::post( 'checkout/checkout', 'Api\CheckoutController@checkout' );

	// Address
	Route::post( 'address', 'Api\AddressController@store' );
	Route::delete( 'address/{id}', 'Api\AddressController@destroy' );

} );

//Route::post( 'checkout/address', 'Api\CheckoutController@address' );

Route::get( 'countries', 'Api\DataController@countries' );

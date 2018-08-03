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

	Route::post( 'translations', 'Api\TranslationController@store' );
	Route::post( 'languages', 'Api\LanguageController@store' );
	Route::post( 'profile', 'Api\UserController@store' );
	Route::post( 'artwork', 'Api\ArtworkController@store' );
	Route::post( 'pages', 'Api\PageController@store' );

	Route::put( 'favourites/{id}/toggle', 'Api\UserController@toggleFavouriteArtwork' );

	// Upload files
	Route::any( 'upload/user-avatar', 'Api\UserController@uploadUserAvatar' );
	Route::any( 'upload/user-image', 'Api\UserController@uploadUserImage' );
	Route::any( 'upload/artwork-image/{id}', 'Api\ArtworkController@uploadArtworkImage' );
	Route::any( 'remove/artwork-image/{id}', 'Api\ArtworkController@removeArtworkImage' );

} );

Route::put( 'cart/{id}/toggle', 'Api\ArtworkController@toggleCart' );


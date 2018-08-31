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
	Route::post( 'artwork', 'Api\ArtworkController@store' );
	Route::post( 'pages', 'Api\PageController@store' );

	Route::put( 'user/favourite/{id}/toggle', 'Api\UserController@toggleFavouriteArtwork' );
	Route::put( 'user/followed/{id}/toggle', 'Api\UserController@toggleFollowedUser' );

	Route::get( 'user/check-username/{username}', 'Api\UserController@checkUsername' );
	Route::post( 'user', 'Api\UserController@destroy' )->middleware('admin');


	// Upload files
	Route::any( 'upload/user-avatar', 'Api\UserController@uploadUserAvatar' );
	Route::any( 'upload/user-image', 'Api\UserController@uploadUserImage' );
	Route::any( 'upload/artwork-image/{id}', 'Api\ArtworkController@uploadArtworkImage' );
	Route::any( 'remove/artwork-image/{id}', 'Api\ArtworkController@removeArtworkImage' );

	// Change email
	Route::post( 'change-email', 'Auth\ConfirmEmailController@changeEmail');

	// Adds
	Route::get( 'user-add/{name}/{price}/{period?}', 'Api\AddController@createUserAdd');
	Route::get( 'artwork-add/{id}/{name}/{price}/{period?}', 'Api\AddController@createArtworkAdd');

} );

Route::get( 'countries', 'Api\DataController@countries');

Route::put( 'cart/{id}/toggle', 'Api\CartController@toggleCart' );


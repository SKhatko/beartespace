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

Route::post( 'login', 'Api\AuthController@login' );
Route::post( 'register', 'Api\AuthController@register' );
Route::get( 'register/activate/{token}', 'Api\AuthController@registerActivate' );

Route::group( [ 'middleware' => 'auth:api' ], function () {
	Route::get( 'logout', 'AuthController@logout' );
	Route::get( 'user', 'AuthController@user' );
} );


Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {
	return $request->user();
} );


Route::post( 'translations', 'Api\TranslationController@store' );
Route::post( 'languages', 'Api\LanguageController@store' );
Route::post( 'profile', 'Api\UserController@store' );
Route::post( 'artwork', 'Api\ArtworkController@store' );
Route::post( 'pages', 'Api\PageController@store' );

// Upload files
Route::any( 'upload/user-photo/{id}', 'Api\UserController@uploadUserPhoto' );
Route::any( 'upload/artwork-image/{id}', 'Api\ArtworkController@uploadArtworkImage' );
Route::any( 'remove/artwork-image/{id}', 'Api\ArtworkController@removeArtworkImage' );

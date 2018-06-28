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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function() {

});

Route::post('translations', 'Api\TranslationController@store');
Route::post('languages', 'Api\LanguageController@store');
Route::any('profile', 'Api\UserController@store');
Route::post('artwork', 'Api\ArtworkController@store');
Route::post('pages', 'Api\PageController@store');

// Upload files
Route::any('upload/user-photo/{id}', 'Api\MediaController@uploadUserPhoto');
Route::any('upload/artwork-image/{id}', 'Api\MediaController@uploadArtworkImage');



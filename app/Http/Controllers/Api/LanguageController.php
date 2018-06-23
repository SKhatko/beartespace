<?php

namespace App\Http\Controllers\Api;

use App\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LanguageController extends Controller {
	public function store( Request $request ) {

		$languageIds = array_pluck( $request->all(), 'id' );
		Language::whereNotIn( 'id', $languageIds )->delete();

		foreach ( $request->all() as $language ) {

			$language_exist = Language::where( 'code', $language['code'] )->get();

			if ( count( $language_exist ) > 1 ) {
				Language::destroy( $language['id'] );
			} else {
				Language::updateOrCreate( [ 'id' => $language['id'] ], $language );
			}
		}

		return response()->json( [ 'success' => true ] );

	}
}

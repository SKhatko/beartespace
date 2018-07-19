<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use PeterColes\Languages\LanguagesFacade as TranslatedLanguages;

class LanguageController extends Controller {

	public function index() {

		$title               = trans( 'app.language_settings' );
		$languages           = Language::all();
		$translatedLanguages = TranslatedLanguages::lookup();

		return view( 'dashboard.admin.languages', compact( 'title', 'languages', 'translatedLanguages' ) );
	}

	/**
	 * Switch Language
	 */
	public function switchLang( $lang ) {

		$langExists = Language::where('code', $lang)->where( 'active', 1 )->first();

		if ( $langExists ) {
			session( [ 'lang' => $lang ] );
		}

		return back();
	}


}

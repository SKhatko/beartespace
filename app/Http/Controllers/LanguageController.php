<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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

		$langExists = Language::whereCode( $lang )->whereActive( 1 )->first();

		if ( $langExists ) {
			Cookie::queue( Cookie::make( 'locale', $lang, 60 * 24 * 365 ) );
//			session( [ 'lang' => $lang ] );
		}

		return back();
	}


}

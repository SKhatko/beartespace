<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;


class TranslationController extends Controller {

	public function index() {

		$translations = LanguageLine::all();

		return view( 'dashboard.translations', compact( 'translations' ) );
	}
}

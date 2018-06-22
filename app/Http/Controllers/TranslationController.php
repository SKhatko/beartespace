<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;
use App\Language;


class TranslationController extends Controller {

	public function index() {

		$translations = LanguageLine::all();
		$languages = Language::all();

		return view( 'dashboard.admin.translations', compact( 'translations', 'languages') );
	}
}

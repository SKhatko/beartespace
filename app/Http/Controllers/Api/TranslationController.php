<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\TranslationLoader\LanguageLine;

class TranslationController extends Controller
{
    public function store(Request $request)
    {
	    // delete removed translations
	    $translationIDs = array_pluck($request->all(), 'id');
	    LanguageLine::whereNotIn('id', $translationIDs)->delete();

	    // update or create translations
	    foreach ($request->all() as $translation) {
		    LanguageLine::updateOrCreate(['id' => $translation['id']], $translation);
	    }

//
//		    LanguageLine::create([
//			    'group' => 'validation',
//			    'key' => 'required',
//			    'text' => ['en' => 'This is a required field', 'nl' => 'Dit is een verplicht veld'],
//		    ]);

	    return response()->json(['success' => true]);

    }
}

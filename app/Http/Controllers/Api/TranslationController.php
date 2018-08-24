<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\TranslationLoader\LanguageLine;

class TranslationController extends Controller
{
    public function update(Request $request)
    {

    	foreach ($request->all() as $group => $translations) {

		    // delete removed translations
		    $translationIDs = array_pluck($request->input($group), 'id');
		    LanguageLine::whereGroup($group)->whereNotIn('id', $translationIDs)->delete();

    		foreach ($translations as $translation) {
			    LanguageLine::updateOrCreate(['id' => $translation['id']], $translation);
		    }
	    }

	    $translations = LanguageLine::all();
    	$translations = $translations->groupBy('group');

	    return ['status'=> 'success', 'message' => 'Saved', 'data' => $translations];

    }
}

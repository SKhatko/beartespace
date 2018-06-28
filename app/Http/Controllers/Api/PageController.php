<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class PageController extends Controller {
	public function store( Request $request ) {

		Page::updateOrCreate( [ 'id' => $request->input( 'id' ) ], $request->except(['id']) );

		$pages = Page::all();

		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $pages ];
	}
}

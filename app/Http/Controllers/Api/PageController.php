<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class PageController extends Controller {

	public function store( Request $request ) {

		$page = Page::create($request->all());

		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $page ];
	}

	public function update( Request $request ) {

		$page = Page::findOrFail( $request->id );

		$page->update( $request->all() );

		return $page;
	}
}

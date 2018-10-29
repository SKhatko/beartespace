<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Language;

class PageController extends Controller {

	public function page($id, $slug = '') {

		$page = Page::findOrFail( $id );

		if ($slug !== $page->slug) {
			return redirect($page->url);
		}

		return view( 'pages.page', compact( 'page' ) );
	}

	public function show( $slug ) {

		$page = Page::whereSlug( $slug )->firstOrFail();

		return view( 'pages.page', compact( 'page' ) );
	}


	public function index() {

		$title     = 'Pages';
		$pages     = Page::orderBy('id', 'desc')->get();

		return view( 'dashboard.page.index', compact( 'title', 'pages' ) );
	}

	public function create() {

		return view('dashboard.page.create');
	}

	public function edit($id) {

		$page = Page::findOrFail($id);

		return view('dashboard.page.edit', compact('page'));
	}
}

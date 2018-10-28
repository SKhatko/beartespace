<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Language;

class PageController extends Controller {

	public function index() {

		$title     = 'Pages';
		$pages     = Page::all();
		$languages = Language::all();

		return view( 'dashboard.page.index', compact( 'title', 'pages', 'languages' ) );
	}

	public function show( $slug ) {

		$page = Page::whereSlug( $slug )->firstOrFail();

		return view( 'pages.page', compact( 'page' ) );
	}

	public function create() {

		return view('dashboard.page.create');
	}

	public function edit($id) {

		$page = Page::findOrFail($id);

		return view('dashboard.page.edit', compact('page'));
	}
}

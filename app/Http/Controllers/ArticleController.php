<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller {
	public function index() {

		$articles = Article::all();

		return view( 'dashboard.article.index', compact( 'articles' ) );
	}

	public function create() {

		return view('dashboard.article.create');
	}

	public function edit($id) {

		$article = Article::findOrFail( $id );

		return view('dashboard.article.edit', compact('article'));
	}

	public function articles() {

		$articles = Article::all();

		return view( 'article.index', compact( 'articles' ) );
	}

	public function article( $id ) {

		$article = Article::findOrFail( $id );

		return view( 'article.show', compact( 'article' ) );
	}
}

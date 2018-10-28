<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller {

	public function index() {

		$articles = Article::orderBy('created_at', 'desc')->get();

		return view( 'dashboard.article.index', compact( 'articles' ) );
	}

	public function create() {

		return view('dashboard.article.create');
	}

	public function edit($id) {

		$article = Article::whereId( $id )->with( 'images' )->firstOrFail();

		return view('dashboard.article.edit', compact('article'));
	}

	public function articles() {

		$articles = Article::orderBy('created_at', 'desc')->paginate();
//		$articles = Article::with( 'images' )->paginate();

		return view( 'article.index', compact( 'articles' ) );
	}

	public function article( $id, $slug = '') {

		$article = Article::findOrFail( $id );

		if ($slug !== $article->slug) {
			return redirect($article->url);
		}

		return view( 'article.show', compact( 'article' ) );
	}
}

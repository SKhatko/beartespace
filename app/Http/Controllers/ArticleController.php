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

	public function articles( Request $request ) {


		$articles = Article::query();

		if ( $request->input( 'article-category' ) ) {
			$queries = explode( ',', $request->input( 'artwork-category' ) );
			foreach ( $queries as $query ) {
				$articles->whereRaw( 'LOWER(category) LIKE ?', '%' . $query . '%' );
			}
		}

		$items = 15;

		if ( $request->has( 'items' ) && $request->input( 'items' ) > 1 ) {
			$items = $request->get( 'items' );
		}

		$articles = $articles->orderBy('created_at', 'desc')->paginate( $items );

//		foreach($articles as $article) {
//			dump($article->category);
//		}

		return view( 'article.index', compact( 'articles' ) );
	}

	public function article( $id, $slug = '') {

		$article = Article::findOrFail( $id );

		if ($slug !== $article->slug) {
			return redirect($article->url);
		}

		$articles = Article::whereCategory($article->category)->where('id', $article->id)

		return view( 'article.show', compact( 'article', 'articles' ) );
	}
}

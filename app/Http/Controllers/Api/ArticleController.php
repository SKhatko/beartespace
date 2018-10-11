<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller {

	public function store( Request $request ) {

		$article = auth()->user()->articles()->create($request->all());

		return $article;
	}

	public function update( Request $request ) {

		$article = Article::findOrFail($request->id);

		$article->update($request->all());

		return $article;
	}
}

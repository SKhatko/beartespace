<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	public function index() {

		return view('dashboard.admin.articles');
	}

    public function articles() {
    	$articles = Article::all();

    	return $articles;

    	return view('article.index', compact('articles'));
    }

    public function article($id) {
    	return 'article ' . $id;
    }
}

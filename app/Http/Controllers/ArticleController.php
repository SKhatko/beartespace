<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
    	$articles = Article::all();

    	return $articles;
    	return view('article.index', compact('articles'));
    }

    public function show($id) {
    	return 'article ' . $id;
    }
}

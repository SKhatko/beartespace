<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
    	return 'articles';
    }

    public function show($id) {
    	return 'article ' . $id;
    }
}

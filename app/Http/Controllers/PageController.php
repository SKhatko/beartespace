<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Language;

class PageController extends Controller
{
	public function index()
	{
		$title = 'Pages';
		$pages = Page::all();
		$languages = Language::all();

		return view('dashboard.admin.pages', compact('title', 'pages', 'languages'));
	}
}

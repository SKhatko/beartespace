<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;
use App\User;
use App\Artwork;

class SettingController extends Controller
{
	public function index() {

		$options = Option::all();

		$artists = User::artist()->get();

		$artworks = Artwork::all();

		return view( 'dashboard.admin.settings', compact('options', 'artists', 'artworks' ) );
	}
}

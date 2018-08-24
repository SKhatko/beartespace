<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\User;
use App\Artwork;

class SettingController extends Controller
{
	public function index() {

		$settings = Setting::first();

		$artists = User::artist()->get();

		$artworks = Artwork::all();

		return view( 'dashboard.admin.settings', compact('settings', 'artists', 'artworks' ) );
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
	public function index() {

		$settings = Setting::all();
		return view( 'dashboard.admin.settings', compact('settings' ) );
	}
}

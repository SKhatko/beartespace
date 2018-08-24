<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller {
	public function update( Request $request ) {

		$setting = Setting::findOrFail( $request->id );

		$setting->update( $request->except( 'id' ) );

		return [ 'status' => 'success', 'message' => 'Settings Saved', 'data' => $setting ];
	}
}

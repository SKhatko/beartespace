<?php

namespace App\Http\Controllers\Api;

use App\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller {

	public function update( Request $request ) {

		foreach ( $request->all() as $key => $option ) {
			$model = Option::find( $option['id'] );

			$model->update( [
				'json_value' => $option['json_value'],
				'text_value' => $option['text_value']
			] );
		}

		$options = Option::all();

		return [ 'status' => 'success', 'message' => 'Settings Saved', 'data' => $options ];
	}
}

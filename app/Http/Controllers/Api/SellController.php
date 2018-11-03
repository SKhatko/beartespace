<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellController extends Controller {

	public function apply( Request $request ) {
//
//		$request->validate( [
//			'first_name' => 'required|string|max:255',
//			'last_name'  => 'required|string|max:255',
//			'seller_type'  => 'required|string|in:artist,gallery',
//		] );

		$user = auth()->user();

		$user->update( $request->except( [
			'avatar',
			'image',
			'avatar_url',
			'image_url',
		] ) );

		return [ 'status' => 'success', 'message' => 'Saved', 'data' => $user ];
	}
}

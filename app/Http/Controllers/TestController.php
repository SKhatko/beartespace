<?php

namespace App\Http\Controllers;

use App\Notifications\SignupActivate;
use App\User;
use Illuminate\Http\Request;

class TestController extends Controller {

	public function testAuth() {
		$user = User::where('email', 's.a.hatko@gmail.com')->firstOrFail();

		$user->notify( new SignupActivate( $user ) );

		return 'pass';
	}
}

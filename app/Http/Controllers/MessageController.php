<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller {

	public function index() {

		$title = trans( 'app.contact_messages' );

		return view( 'dashboard.admin.messages', compact( 'title' ) );
	}
}

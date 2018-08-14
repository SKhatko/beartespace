<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;

class LeadController extends Controller {
	public function addLead( Request $request ) {

		$request->validate( [
			'email' => 'required|email'
		] );

		Lead::updateOrCreate( [ 'email' => $request->input( 'email' ) ] );

		$cookie = cookie( 'email_lead_subscription', true, 60 * 24 * 365 );

		return back()->cookie( $cookie )->with('alert', [
			'title'   => 'Thank you for email subscription',
			'message' => 'You successfully subscribed for our newsletters'
		]);
	}
}

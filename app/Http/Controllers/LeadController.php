<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;

class LeadController extends Controller
{
    public function addLead(Request $request) {

    	$request->validate([
    		'email' => 'required|email'
	    ]);

    	Lead::updateOrCreate(['email' => $request->input('email')]);

    	return back();
    }
}

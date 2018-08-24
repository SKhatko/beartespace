<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;

class DataController extends Controller
{
    public function countries() {

	    $countries = Country::all( 'country_name', 'id', 'citizenship' );

	    return $countries;
    }
}

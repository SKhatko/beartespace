<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {

    	$orders =  auth()->user()->orders;
    	$artworks = $orders->pluck('artworks');

    	return $artworks;

//    	return auth()->user()->payments;
//    	return $orders->count();

    	return view('dashboard.user.orders', compact('orders'));
    }
}

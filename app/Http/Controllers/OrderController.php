<?php

namespace App\Http\Controllers;

use App\Artwork;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class OrderController extends Controller
{
    public function index() {

    	$orders =  auth()->user()->orders()->get();

    	// TODO looks too creepy, takes ids from cart and push it to one dimensional array of id's
    	$artworkIds = [];
    	foreach($orders as $order) {
    		$ids = collect($order->cart)->pluck('id');
		    foreach($ids as $id) {
		    	if(!in_array($id, $artworkIds)) {
		    		array_push($artworkIds, $id);
			    }
		    }
	    }

    	$artworks = Artwork::findMany($artworkIds);

    	return view('dashboard.user.orders', compact('orders', 'artworks'));
    }
}

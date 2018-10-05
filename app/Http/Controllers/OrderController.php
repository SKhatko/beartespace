<?php

namespace App\Http\Controllers;

use App\Jobs\OrderCreated;
use App\Order;
use App\Sale;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller {

	public function index() {

		$orders = auth()->user()->orders()->get();

		$order = auth()->user()->orders()->first();

//		Mail::to( 'support@beartespace.com' )->queue( new \App\Mail\OrderCreated( $order ) );

//		return $order;

//		return new \App\Mail\OrderCreated( $order );


//		OrderCreated::dispatch($order);
//		CreateSale::dispatch( $order );



		// TODO looks too creepy, takes ids from cart and push it to one dimensional array of id's
//		$artworkIds = [];
//		foreach ( $orders as $order ) {
//			$ids = collect( $order->cart )->pluck( 'id' );
//			foreach ( $ids as $id ) {
//				if ( ! in_array( $id, $artworkIds ) ) {
//					array_push( $artworkIds, $id );
//				}
//			}
//		}

//		$artworks = Artwork::findMany( $artworkIds );

		return view( 'dashboard.user.orders', compact( 'orders' ) );
	}
}

<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller {

	public function index() {

		$orders = auth()->user()->orders()->get();

//		$payment = auth()->user()->payments()->first();


//		Mail::to( $orders->first()->user )->send( new \App\Mail\OrderCreated( $orders->first() ) );
//		foreach ( $orders->first()->sales as $sale ) {
//			Mail::to( $orders->first()->user )->send( new \App\Mail\SaleCreated( $sale ) );
//		}

//		\App\Jobs\CreateSale::dispatch($orders->first());

//		\App\Jobs\OrderCreated::dispatch($orders->first());

//		\App\Jobs\CreateSale::dispatch( $orders->first() );


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

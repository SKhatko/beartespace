<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class OrderController extends Controller {

	public function index() {

		$orders = auth()->user()->orders()->first();

		return $orders->sales;
		\App\Jobs\PlaceOrder::dispatch($orders);

		foreach ( $orders->content as $item ) {
//			$d = $orders->sales()->create( [
//				'user_id'    => $item->model->user_id,
//				'artwork_id' => $item->id,
//				'qty'        => $item->qty,
//				'price'      => $item->price
//			] );
//
//			dump($d);



//			ArtworkSold::dispatch( $item->model, $item->qty );
		}
		dd( $orders->sales);
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

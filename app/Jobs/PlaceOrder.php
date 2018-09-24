<?php

namespace App\Jobs;

use App\Order;
use App\Mail\OrderPaid;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class PlaceOrder implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct( Order $order ) {
		// Store cart to db
		try {
			Cart::store( $order->id );
		} catch ( \Exception $ex ) {
			logger( $ex->getMessage() );
		}

		// Make item sold
		foreach ( $order->shoppingcart->content as $artwork ) {
			ArtworkSold::dispatch( $artwork->model, $artwork->qty );
		}

		Mail::to( auth()->user() )->send( new OrderPaid( $order ) );

		Cart::destroy();
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
		//
	}
}

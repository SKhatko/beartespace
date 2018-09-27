<?php

namespace App\Jobs;

use App\Order;
use App\Sale;
use App\Mail\OrderPaid;
use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class PlaceOrder implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $order;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct( Order $order ) {

		$this->order = $order;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {

		// Make item sold
		foreach ( $this->order->content as $item ) {
			$sale = Sale::create( [
				'order_id'   => $this->order->id,
				'user_id'    => $item->model->user_id,
				'artwork_id' => $item->id,
				'qty'        => $item->qty,
				'price'      => $item->price,
			] );

//			$sale->save();

//			dump( $sale );

//			ArtworkSold::dispatch( $sale, $item->model, $item->qty );
		}

//		Mail::to( auth()->user() )->send( new OrderPaid( $order ) );

//		Cart::destroy();
	}
}

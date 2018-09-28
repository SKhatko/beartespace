<?php

namespace App\Jobs;

use App\Mail\OrderCreated;
use App\Order;
use App\Payment;
use App\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrder implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $payment;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct( Payment $payment ) {

		$this->payment = $payment;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {

		$order = new Order();
		$order->save();

		$order->update( [
			'user_id'    => $this->payment->user_id,
			'address'    => $this->payment->user->primaryAddress,
			'amount'     => Cart::total(),
			'payment_id' => $this->payment->id,
			'content'    => serialize( Cart::content() )
		] );

		foreach ( $order->content as $item ) {

			Sale::create( [
				'order_id'   => $order->id,
				'user_id'    => $item->model->user_id,
				'artwork_id' => $item->id,
				'qty'        => $item->qty,
				'price'      => $item->price,
			] );
		}

		Mail::to( $this->payment->user )->send( new OrderCreated( $order ) );

	}
}

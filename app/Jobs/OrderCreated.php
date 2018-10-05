<?php

namespace App\Jobs;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class OrderCreated implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $order;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct( Order $order ) {

		$this->order = $order;

//		Mail::to( 's.a.hatko@gmail.com' )->queue( new \App\Mail\OrderCreated( $this->order ) );
		Mail::to( $this->order->user )->queue( new \App\Mail\OrderCreated( $this->order ) );

		foreach ($this->order->sales as $sale) {
			Mail::to( $sale->user )->queue( new \App\Mail\SaleCreated( $sale ) );
//			Mail::to( 's.a.hatko@gmail.com' )->queue( new \App\Mail\SaleCreated( $sale ) );
		}

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

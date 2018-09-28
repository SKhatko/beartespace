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
	public function __construct( \App\Order $order ) {
		logger( 'Order Created job, send email to ' . $order->user->email );

		$this->order = $order;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
		dispatch(new CreateSale($this->order));

//		$this->dispatch(new CreateSale($this->order));

		Mail::to( $this->order->user )->send( new \App\Mail\OrderCreated( $this->order ) );
	}
}
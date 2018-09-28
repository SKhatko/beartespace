<?php

namespace App\Jobs;

use App\Order;
use App\Sale;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class CreateSale implements ShouldQueue {
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

		foreach ( $this->order->content as $item ) {
			$sale = Sale::create( [
				'order_id'   => $this->order->id,
				'user_id'    => $item->model->user_id,
				'artwork_id' => $item->id,
				'qty'        => $item->qty,
				'price'      => $item->price,
			] );

			$sale->save();

			logger( 'Sale create job' );
			logger( $sale );

//			Mail::to( $sale->user )->send( new \App\Mail\SaleCreated( $sale ) );
			Mail::to( auth()->user() )->send( new \App\Mail\SaleCreated( $sale ) );

		}
	}
}

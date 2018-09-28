<?php

namespace App\Events;

use App\Mail\OrderCreated;
use App\Sale;
use App\Mail\SalePaid;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Mail;

class SaleCreated {
	use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct( Sale $sale ) {

		logger( 'Sale Created event' );
		logger( $sale );

		$artwork = $sale->artwork;
		if ( $artwork->quantity >= $sale->qty ) {
			$artwork->quantity -= $sale->qty;
			$artwork->save();
		}

		if ( $artwork->quantity < 1 ) {
			$artwork->sold = true;
			$artwork->save();
		}

	}

	/**
	 * Get the channels the event should broadcast on.
	 *
	 * @return \Illuminate\Broadcasting\Channel|array
	 */
	public function broadcastOn() {
		return new PrivateChannel( 'channel-name' );
	}
}

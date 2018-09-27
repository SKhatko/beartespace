<?php

namespace App\Events;

use App\Sale;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SaleCreated {
	use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct( Sale $sale ) {

		$artwork = $sale->artwork;
//		dump($artwork->quantity);
		if ( $artwork->quantity >= $sale->qty ) {
//			dump('more then quantity sold');
			$artwork->quantity -= $sale->qty;
			$artwork->save();
		}
//		dump($sale->artwork->quantity);

	    if ( $artwork->quantity < 1 ) {
//	    	dump('mark sold');
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

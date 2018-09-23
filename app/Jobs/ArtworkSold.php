<?php

namespace App\Jobs;

use App\Artwork;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ArtworkSold implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct( Artwork $artwork, $qty = 1 ) {
//	    dump($artwork->quantity, $qty );
		if ( $artwork->quantity >= $qty ) {
			$artwork->quantity -= $qty;
		}

		if ( $artwork->quantity < 1 ) {
			$artwork->sold = true;
		}
//	    dump($artwork->quantity);

		$artwork->save();
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

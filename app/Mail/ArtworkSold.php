<?php

namespace App\Mail;

use App\Order;
use App\Artwork;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArtworkSold extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $artwork;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, Artwork $artwork)
    {
        $this->order = $order;
        $this->artwork = $artwork;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.order.artwork-sold')
	        ->subject( 'Your Artwork has been sold ' . $this->order->created_at->toFormattedDateString() );
    }
}

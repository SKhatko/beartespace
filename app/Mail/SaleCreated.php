<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaleCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $sale;
    /**
     * Create a new message instance.
     *
     * @return void
     */
	public function __construct( Sale $sale ) {

		$this->sale = $sale;
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.sale-created')
	        ->subject( 'Order confirmation from ' . $this->sale->created_at->toFormattedDateString() );

    }
}

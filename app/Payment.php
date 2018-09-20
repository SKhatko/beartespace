<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
	protected $guarded = [];

	public function order() {
		return $this->belongsTo( Order::class );
	}

	public function user() {
		return $this->belongsTo( User::class );
	}

	public function payment_completed_at() {
		$created_date_time = '';
		if ( $this->attributes['payment_created'] ) {
			$created_date_time = Carbon::createFromTimestamp( $this->attributes['payment_created'], get_option( 'default_timezone' ) )->format( get_option( 'date_format_custom' ) . ' ' . get_option( 'time_format_custom' ) );
		}

		return $created_date_time;
	}
}

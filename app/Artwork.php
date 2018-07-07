<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Artwork extends Model {
	protected $guarded = [];

	protected $casts = [
		'medium'    => 'array',
		'direction' => 'array',
		'theme'     => 'array',
		'color'     => 'array',
		'image'     => 'array'
	];

	public function user() {
		return $this->belongsTo( User::class );
	}

	public function category() {
		return $this->belongsTo( Category::class );
	}

	public function images() {
		return $this->hasMany( Media::class );
	}


	public function scopeActive( $query ) {
		return $query->whereStatus( '1' );
	}

	public function scopeSculpture( $query ) {
		return $query->whereCategory( 'sculpture' );
	}

	public function scopePainting( $query ) {
		return $query->whereCategory( 'painting' );
	}

	public function scopeAuction( $query ) {
		return $query->whereAuctionStatus('1');
	}

	public function getOptionalSizeAttribute($value) {
		return !!$value;
	}


	public function posting_datetime() {
		$created_date_time = $this->created_at->timezone( get_option( 'default_timezone' ) )->format( get_option( 'date_format_custom' ) . ' ' . get_option( 'time_format_custom' ) );

		return $created_date_time;
	}

	public function posted_date() {
		$created_date_time = $this->created_at->timezone( get_option( 'default_timezone' ) )->format( get_option( 'date_format_custom' ) );

		return $created_date_time;
	}

	public function expired_date() {
		$created_date_time = date( get_option( 'date_format_custom' ), strtotime( $this->expired_at ) );

		return $created_date_time;
	}


	public function is_my_favorite() {
		if ( ! Auth::check() ) {
			return false;
		}
		$user = Auth::user();

		$favorite = Favorite::whereUserId( $user->id )->whereAdId( $this->id )->first();
		if ( $favorite ) {
			return true;
		} else {
			return false;
		}
	}

	public function reports() {
		return $this->hasMany( ArtworkReport::class );
	}

	public function bids() {
		return $this->hasMany( Bid::class )->orderBy( 'id', 'desc' );
	}

	public function bid_deadline() {
		if ( $this->expired_at ) {
			$dt       = Carbon::createFromTimestamp( strtotime( $this->expired_at ) );
			$deadline = $dt->timezone( get_option( 'default_timezone' ) )->format( get_option( 'date_format_custom' ) );

			return $deadline;
		}

		return false;
	}

	public function bid_deadline_left() {
		if ( $this->expired_at ) {
			$dt       = Carbon::createFromTimestamp( strtotime( $this->expired_at ) );
			$deadline = $dt->diffForHumans();

			return $deadline;
		}

		return false;
	}

	public function current_bid() {
		$last_bid = $this->price;

		$get_last_bid = Bid::whereArtworkId( $this->id )->max( 'bid_amount' );
		if ( $get_last_bid && $get_last_bid > $last_bid ) {
			$last_bid = $get_last_bid;
		}

		return $last_bid;
	}

	public function is_bid_active() {
		$status = true;
		if ( $this->category_type == 'auction' ) {
			$is_accepted_bid = Bid::whereAdId( $this->id )->whereIsAccepted( 1 )->first();
			if ( $is_accepted_bid ) {
				$status = false;
			}

			$expired_date = Carbon::createFromTimestamp( strtotime( $this->expired_at ) );
			if ( $expired_date->isPast() ) {
				$status = false;
			}
		}

		return $status;
	}

	public function is_bid_accepted() {
		$status = false;
		if ( $this->category_type == 'auction' ) {
			$is_accepted_bid = Bid::whereAdId( $this->id )->whereIsAccepted( 1 )->first();
			if ( $is_accepted_bid ) {
				$status = true;
			}
		}

		return $status;
	}

}

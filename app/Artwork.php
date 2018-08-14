<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Artwork extends Model {
	protected $guarded = [];

	protected $appends = ['formatted_price'];

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

	public function scopeAuction( $query ) {
		return $query->whereAuctionStatus('1');
	}

	public function getOptionalSizeAttribute($value) {
		return !!$value;
	}

	public function getAuctionStatusAttribute($value) {
		return !!$value;
	}

	public function getFormattedPriceAttribute() {
		return currency($this->attributes['price'], null, session('currency'));
	}

	public function bids() {
		return $this->hasMany( Bid::class );
	}

	public function size() {
		return $this->width . ' x ' . $this->height . ' cm';
	}
}

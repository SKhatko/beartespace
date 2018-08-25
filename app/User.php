<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable {
	use HasApiTokens, Billable, Notifiable, SoftDeletes;

	protected $dates = [ 'deleted_at' ];

	protected $appends = [ 'avatar_url', 'image_url', 'profile_background_image' ];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'activation_token'
	];

	protected $casts = [
		'medium'    => 'array',
		'direction' => 'array',
	];

	public function country() {
		return $this->belongsTo( Country::class );
	}

	public function artworks() {
		return $this->hasMany( Artwork::class );
	}

	public function articles() {
		return $this->hasMany( Article::class );
	}

	public function favouriteArtworks() {
		return $this->belongsToMany( Artwork::class, 'favorites' );
	}

	public function orders() {
		return $this->hasMany( Order::class );
	}

	public function currency() {
		return $this->belongsTo( Currency::class );
	}

	public function avatar() {
		return $this->hasOne( Media::class, 'avatar_id' );
	}

	public function image() {
		return $this->hasOne( Media::class, 'image_id' );
	}

	public function adds() {
		return $this->hasMany( Add::class, 'user_id' );
	}


	public function isAdmin() {
		return $this->user_type == 'admin';
	}

	public function isUser() {
		return $this->user_type == 'user';
	}

	public function isGallery() {
		return $this->user_type == 'gallery';
	}

	public function isArtist() {
		return $this->user_type == 'artist';
	}

	public function scopeArtist( $query ) {
		return $query->where( 'user_type', 'artist' );
	}

	public function getNameAttribute() {
		return trim( $this->first_name ) . ' ' . trim( $this->last_name );
	}

	public function setNameAttribute() {
		return trim( $this->first_name ) . ' ' . trim( $this->last_name );
	}

	public function plans() {
		return $this->hasMany( Plan::class, 'user_type', 'user_type' );
	}

	public function getAvatarUrlAttribute() {
		if ( $this->avatar && file_exists( public_path( 'storage' . $this->avatar->url ) ) ) {
			return $this->avatar->url;
		} else {
//			file_exists(public_path('images/avatar-placeholder.png'));
			return '/avatar-placeholder.png';
		}
	}

	public function getImageUrlAttribute() {
		if ( $this->image && file_exists( public_path( 'storage' . $this->image->url ) ) ) {
			return $this->image->url;
		} else {
//			file_exists(public_path('images/avatar-placeholder.png'));
			return '/no-image-placeholder.png';
		}
	}

	public function deductFromBalance($price) {
		$this->attributes['balance'] -= $price;
		$this->save();
	}

	public function getProfileBackgroundImageAttribute() {
		return $this->adds()->whereName( 'profile-background-image' )->first();
	}

	public function getMediumAttribute() {
		if ( $this->attributes['medium'] ) {
			return json_decode( $this->attributes['medium'] );
		} else {
			return [];
		}
	}

	public function getDirectionAttribute() {
		if ( $this->attributes['direction'] ) {
			return json_decode( $this->attributes['direction'] );
		} else {
			return [];
		}
	}


	public function status_context() {
		$status = $this->active_status;

		$context = '';
		switch ( $status ) {
			case '0':
				$context = 'Pending';
				break;
			case '1':
				$context = 'Active';
				break;
			case '2':
				$context = 'Block';
				break;
		}

		return $context;
	}

}

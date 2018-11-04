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

	protected $appends = [
		'avatar_url',
		'image_url',
	];

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
		'profession' => 'array',
	];

	public function country() {
		return $this->belongsTo( Country::class );
	}

	public function artworks() {
		return $this->hasMany( Artwork::class );
	}

	public function payments() {
		return $this->hasMany( Payment::class );
	}

	public function articles() {
		return $this->hasMany( Article::class );
	}

	public function sales() {
		return $this->hasMany( Sale::class );
	}

	public function favoriteArtworks() {
		return $this->belongsToMany( Artwork::class, 'favorites' );
	}

	public function followedUsers() {
		return $this->belongsToMany( User::class, 'follows', 'follower_id' );
	}

	public function followedBy() {
		return $this->belongsToMany( User::class, 'follows', 'user_id', 'follower_id' );
	}

	public function addresses() {
		return $this->belongsToMany( Address::class, 'user_addresses' );
	}

	public function primaryAddress() {
		return $this->belongsTo( Address::class, 'address_id' );
	}

	public function orders() {
		return $this->hasMany( Order::class );
	}

	public function currency() {
		return $this->belongsTo( Currency::class );
	}

	public function avatar() {
		return $this->belongsTo( Media::class );
	}

	public function image() {
		return $this->belongsTo( Media::class );
	}

	public function adds() {
		return $this->hasMany( Add::class, 'user_id' );
	}

	public function isAdmin() {
		return $this->role == 'admin';
	}

	public function isUser() {
		return $this->user_type == 'user';
	}

	public function isGallery() {
		return $this->seller_type == 'gallery';
	}

	public function isArtist() {
		return $this->seller_type == 'artist';
	}

	public function scopeSeller( $query ) {
		return $query->whereNotNull( 'seller_type' );
	}

	public function scopeSellerStatus( $query, $value ) {
		return $query->where( 'seller_status', $value );
	}

	public function scopeArtist( $query ) {
		return $query->where( 'seller_type', 'artist' );
	}

	public function getNameAttribute( $value ) {
		return $value ?? trim( $this->first_name ) . ' ' . trim( $this->last_name );
	}

	public function getProfileNameAttribute( $value ) {
		return $value ?? str_slug( $this->name );
	}

	public function plans() {
		return $this->hasMany( Plan::class, 'user_type', 'user_type' );
	}

	public function getAvatarUrlAttribute() {

		if ( $this->avatar && file_exists( public_path( $this->avatar->url ) ) ) {
			return $this->avatar->url;
		} else {
//			file_exists(public_path('images/avatar-placeholder.png'));
			return '/avatar-placeholder.png';
		}
	}

	public function getImageUrlAttribute() {
		if ( $this->image && file_exists( public_path( $this->image->url ) ) ) {
			return $this->image->url;
		} else {
			return '/no-image-placeholder.png';
		}
	}

	public function getEducationBornAttribute( $value ) {
		return ! ! $value;
	}

	public function deductFromBalance( $price ) {
		$this->attributes['balance'] -= $price;
		$this->save();
	}

	public function getUrlAttribute() {
		if($this->seller_type) {
			return action( 'UserController@seller', $this->profile_name );
		} else {
			return action( 'UserController@person', $this->id );
		}
	}

	public function getMediumAttribute() {
		$mediumm = $this->artworks->map( function ( $artwork ) {
			return $artwork->pluck( [ 'medium', 'id' ] );
		} );

		return $mediumm;
	}

	public function getProfessionAttribute() {
		if ( $this->attributes['profession'] ) {
			return json_decode( $this->attributes['profession'] );
		} else {
			return [];
		}
	}

}

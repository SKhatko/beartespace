<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
	protected $appends = [ 'image_url' ];

	protected $casts = [
		'tags' => 'array',
	];

	protected $fillable = [ 'name', 'content', 'image_id', 'source', 'source_url', 'tags', 'category' ];

	public function images() {
		return $this->belongsToMany( Media::class, 'article_images', 'article_id', 'media_id' );
	}

	public function user() {
		return $this->belongsTo( User::class );
	}

	public function image() {
		return $this->belongsTo( Media::class );
	}

	public function getImageUrlAttribute() {
		if ( $this->image && file_exists( public_path( $this->image->url ) ) ) {
			return $this->image->url;
		} else {
			return '/no-image-placeholder.png';
		}
	}

	public function getUrlAttribute() {
		return action( 'ArticleController@article', [ $this->id, $this->slug ] );
	}

	public function getSlugAttribute() {
		return str_slug( $this->name );
	}
}

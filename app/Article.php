<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
	protected $appends = [ 'image_url' ];

	protected $fillable = ['name', 'content', 'image_id'];

	public function images() {
		return $this->belongsToMany( Media::class, 'article_images', 'article_id', 'media_id' );
	}

	public function image() {
		return $this->belongsTo( Media::class );
	}

	public function getImageUrlAttribute() {
		if ( $this->image && file_exists( public_path( 'storage' . $this->image->url ) ) ) {
			return $this->image->url;
		} else {
			return '';
		}
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
	protected $appends = [ 'image_url' ];

	public function image() {
		return $this->hasOne( Media::class, 'article_id' );
	}

	public function getImageUrlAttribute() {
		if ( $this->image && file_exists( public_path( 'storage' . $this->image->url ) ) ) {
			return $this->image->url;
		} else {
			return '';
		}
	}
}

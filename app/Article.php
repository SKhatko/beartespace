<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

	public function image() {
		return $this->hasOne( Media::class, 'article_id');
	}
}

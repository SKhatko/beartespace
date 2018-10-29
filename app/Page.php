<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
	use HasTranslations;

	public $translatable = ['content'];

	protected $guarded = [];

	protected $casts = ['content' => 'array'];

	public function getSlugAttribute() {
		return str_slug($this->name);
	}

	public function getUrlAttribute() {
		return action( 'PageController@page', [ $this->id, $this->slug ] );

	}

}

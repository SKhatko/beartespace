<?php

namespace App;

use App\Events\MediaDeleted;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Media extends Model {
	use Notifiable;

	protected $appends = ['url'];

	protected $guarded = [];

	protected $dispatchesEvents = [
		'deleted' => MediaDeleted::class,
	];

	public function getUrlAttribute() {
		return $this->attributes['folder'] . '/' . $this->attributes['name'];
	}

//	public function setUrlAttribute() {
//		$this->attributes['url'] = $this->attributes['folder'] . '/' . $this->attributes['name'];
//	}

}

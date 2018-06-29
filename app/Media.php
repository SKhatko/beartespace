<?php

namespace App;

use App\Events\MediaDeleted;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
	use Notifiable;

	protected $guarded = [];

	protected $dispatchesEvents = [
		'deleted' => MediaDeleted::class,
	];

    public function getUrlAttribute($value) {
    	$id = $this->user_id ?? $this->artwork_id;
    	return $this->folder . '/' . $id . '/' . $this->name;
    }
}

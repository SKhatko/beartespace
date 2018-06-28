<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $guarded = [];

    public function getUrlAttribute($value) {
    	$id = $this->user_id ?? $this->artwork_id;
    	return $this->folder . '/' . $id . '/' . $this->name;
    }
}

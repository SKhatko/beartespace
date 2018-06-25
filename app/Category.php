<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function artworks(){
        return $this->hasMany(Artwork::class);
    }
    public function sub_categories(){
        return $this->hasMany('App\Sub_Category')->orderBy('category_name', 'asc');
    }

    public function brands(){
        return $this->hasMany(Brand::class);
    }

    public function product_count(){
        return $this->hasMany(Artwork::class)->whereStatus('1')->count();
    }
}

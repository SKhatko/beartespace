<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtworkReport extends Model
{
    protected $guarded = [];

    public function ad(){
        return $this->belongsTo(Artwork::class);
    }

    public function posting_datetime(){
        $created_date_time = $this->created_at->timezone(get_option('default_timezone'))->format(get_option('date_format_custom').' '.get_option('time_format_custom'));
        return $created_date_time;
    }
}

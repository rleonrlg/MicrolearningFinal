<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class content extends Model
{
    public function course(){
        return $this->belongsTo(Course::class);
    }
}

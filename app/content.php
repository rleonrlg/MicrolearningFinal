<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\content
 *
 * @property-read \App\Course $course
 * @mixin \Eloquent
 */
class content extends Model
{
    protected $fillable = ['course_id', 'File_name', 'size'];
    
    public function course(){
        return $this->belongsTo(Course::class);
    }
}

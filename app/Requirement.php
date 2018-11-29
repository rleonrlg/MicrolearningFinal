<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Requirement
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $course_id
 * @property string $requirement
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requirement whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requirement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requirement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requirement whereRequirement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Requirement whereUpdatedAt($value)
 * @property-read \App\Course $course
 */
class Requirement extends Model
{
    protected $fillable = ['course_id', 'requirement'];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}

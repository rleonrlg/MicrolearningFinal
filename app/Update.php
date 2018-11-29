<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Update
 *
 * @property int $id
 * @property int $course_id
 * @property string $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Update extends Model
{

    protected $fillable = ['course_id', 'file'];

    public function pathAttachment(){
        return "/storage/content/" . $this->file;

    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}

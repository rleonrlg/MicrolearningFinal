<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Level
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Level whereUpdatedAt($value)
 * @property-read \App\Course $course
 */
class Level extends Model
{
    public function course(){
        return $this->hasOne(Course::class);
    }
}

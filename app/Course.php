<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Course
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $teacher_id
 * @property int $category_id
 * @property int $level_id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string|null $picture
 * @property string $status
 * @property int $previous_approved
 * @property int $previous_rejected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePreviousApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course wherePreviousRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereUpdatedAt($value)
 * @property-read \App\Category $category
 * @property-read mixed $rating
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Goal[] $goals
 * @property-read \App\Level $level
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Requirement[] $requirements
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviews
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[] $students
 * @property-read \App\Teacher $teacher
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Course onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Course withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Course withoutTrashed()
 */
class Course extends Model
{
    use SoftDeletes;

    protected $fillable = ['teacher_id', 'name', 'description', 'picture', 'level_id', 'category_id', 'status'];


    const PUBLISHED = 1;
    const PENDING = 2;
    const REJECTED = 3;

    protected $withCount = ['reviews', 'students'];

    public static function boot()
    {
        parent::boot();

        static::saving(function (Course $course){
           if ( !\App::runningInConsole() ){
               $course->slug = str_slug($course->name, "-");
           }
        });

        static::saved(function (Course $course){
           if ( !\App::runningInConsole()){
               if ( request('requirements')){
                   foreach (request('requirements') as $key => $requirement_input){
                       if ($requirement_input){
                           Requirement::updateOrCreate(['id' => request('requirement_id' . $key)],[
                              'course_id' => $course->id,
                              'requirement' =>$requirement_input
                           ]);
                       }
                   }
               }
               if ( request('goals')){
                   foreach (request('goals') as $key => $goal_input){
                       if ($goal_input){
                           Goal::updateOrCreate(['id' => request('goal_id' . $key)],[
                               'course_id' => $course->id,
                               'goal' =>$goal_input
                           ]);
                       }
                   }
               }
               if ( request('updates')) {
                   foreach (request('updates') as $key => $file_input) {
                      if ($file_input) {
                          $filePath = public_path() . '/storage/content/';
                          $name = $file_input->getClientOriginalName();
                          $file_input->move($filePath, $name);
                          Update::updateOrCreate(['id' => request('update_id' . $key)],[
                              'course_id' => $course->id,
                              'file' => $name
                          ]);
                      }
                   }
               }
           }
        });
    }


    public function pathAttachment(){
        return "/images/courses/" . $this->picture;

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function category(){
        return $this->belongsTo(Category::class)->select('id', 'name');
    }

    public function goals(){
        return $this->hasMany(Goal::class)->select('id', 'course_id', 'goal');
    }

    public function level(){
        return $this->belongsTo(Level::class)->select('id', 'name');
    }

    public function reviews(){
        return $this->hasMany(Review::class)->select('id', 'user_id', 'course_id', 'rating', 'comment', 'created_at');
    }

    public function requirements(){
        return $this->hasMany(Requirement::class)->select('id', 'course_id', 'requirement');
    }

    public function updates() {
        return $this->hasMany(Update::class)->select('id', 'course_id', 'file');
    }

    public function students(){
        return $this->belongsToMany(Student::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    public function getRatingAttribute(){
        return $this->reviews->avg('rating');
    }

    public function relatedCourses(){
        return Course::with('reviews')->whereCategoryId($this->category->id)
            ->where('id', '!=', $this->id)
            ->latest()
            ->limit(6)
            ->get();
    }
}

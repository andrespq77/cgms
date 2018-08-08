<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teachers';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name',
        'social_id', 'cc', 'date_of_birth', 'gender', 'telephone', 'mobile', 'moodle_id',
        'inst_email', 'university_name', 'function', 'work_area', 'category',
        'email2', 'phone2', 'work_hours',
        'reason_type', 'action_type', 'action_description', 'speciality',
        'join_date', 'end_date', 'amie', 'disability', 'ethnic_group',
        'province', 'canton', 'parroquia', 'district', 'district_code', 'zone',
        'parroquia_id', 'user_id', 'created_by', 'updated_by'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy(){
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function allUpcomingCourses(){

        return $this->belongsToMany(Course::class, 'course_requests',
            'teacher_id', 'course_id')
            ->where('course_requests.status', 1)
            ->withPivot('teacher_id', 'course_id', 'course_code', 'teacher_social_id', 'status')
            ->as('allUpcomingCourses')
            ->withTimestamps();

    }


    /**
     * @param $course_id
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getRequestedCourse($course_id){

        return $this->belongsToMany(Course::class, 'course_requests',
            'teacher_id','course_id')
            ->where('course_id', $course_id)
            ->withPivot('teacher_id', 'course_id', 'course_code', 'teacher_social_id', 'status')
            ->as('getRequestedCourse')
            ->withTimestamps();

    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrations(){

        return $this->hasMany(Registration::class, 'teacher_id', 'id');

    }


}

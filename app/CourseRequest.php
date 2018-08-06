<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CourseRequest
 *
 * @package App
 */
class CourseRequest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_requests';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'course_code', 'teacher_id' ,'social_id', 'created_by', 'status',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(){

        return $this->belongsTo('App\Course', 'course_id', 'id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(){

        return $this->belongsTo('App\Teacher', 'teacher_id', 'id');

    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseModality extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_modalities';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'course_type_id', 'sort','created_by', 'updated_by'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courseType(){

        return $this->belongsTo('App\CourseType', 'course_type_id', 'id');

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
}

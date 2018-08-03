<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterCourse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_courses';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'subject_id', 'course_code','created_by', 'updated_by'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses(){

        return $this->hasMany('App\Course', 'master_course_id', 'id');

    }

    public function subject(){
        return $this->belongsTo('App\Category', 'subject_id', 'id');
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

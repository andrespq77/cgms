<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_types';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'is_active', 'sort','created_by', 'updated_by'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function course(){
        return $this->hasMany('App\Course', 'course_type_id', 'id');
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

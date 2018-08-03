<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type', 'label', 'sub_label', 'knowledge', 'subject',
        'parent_id',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterCourses(){

        return $this->hasMany('App\MasterCourse', 'category_id', 'id');

    }


}

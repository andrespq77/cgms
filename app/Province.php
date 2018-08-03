<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'provinces';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'capital',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cantons(){


        return $this->hasMany('App\Canton', 'province_id', 'id');


    }

}

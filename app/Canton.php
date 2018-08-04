<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cantons';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'capital', 'province_id', 'dist_name', 'dist_code', 'zone'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province(){

        return $this->belongsTo('App\Province', 'province_id', 'id');
    }

    /**
     *
     */
    public function Parroquia(){

        $this->hasMany('App\Parroquia', 'canton_id', 'id');
    }

}

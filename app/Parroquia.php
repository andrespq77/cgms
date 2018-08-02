<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parroquias';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'canton_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function canton(){
        return $this->belongsTo('App\Canton', 'canton_id', 'id');
    }

}

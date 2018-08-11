<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role' , 'status', 'creation_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacher(){

        return $this->hasOne('App\Teacher');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function university(){

        return $this->hasOne('App\University');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getRoleAttribute($value){

        return getUserRole($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getStatusAttribute($value){

        return getUserStatus($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getCreationTypeAttribute($value){
        return getUserCreationType($value);
    }
}

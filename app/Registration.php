<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Registration
 *
 * @package App
 */
class Registration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'registrations';


    protected $dates = [
        'diploma_download_time',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reg_date', 'teacher_id', 'course_id', 'user_social_id', 'user_first_name', 'user_last_name',
        'email', 'cell_phone', 'accept_tc', 'tc_accept_time',
        'inspection_certificate', 'inspection_certificate_signed', 'inspection_certificate_upload_time',
        'registry_is_generated', 'is_approved', 'certificate_path', 'diploma_path', 'diploma_download_time',
        'mark', 'mark_approved', 'mark_approved_by', 'mark_upload_time',
        'approval_time', 'approved_by',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approvedBy(){
        return $this->belongsTo('App\User', 'approved_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function markApprovedBy(){
        return $this->belongsTo('App\User', 'mark_approved_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(){
        return $this->belongsTo('App\Teacher', 'teacher_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(){

        return $this->belongsTo('App\Course', 'course_id', 'id');
    }

}

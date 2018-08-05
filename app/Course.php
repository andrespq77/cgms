<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'courses';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_code',
        'short_name', 'description',         'comment',
        'video_text', 'video_code', 'video_type',
        'data_update_brief', 'terms_conditions',
        'inspection_form_url', 'inspection_form_generated',
        'hours',         'quota',
        'start_date', 'end_date',
        'university_id',
        'lor_file_path', 'tc_file_path',
        'diploma_uploaded_by_id', 'diploma_upload_time', 'diploma_uploaded',
        'created_by', 'updated_by',

        'master_course_id', 'cost', 'edition', 'finance_type', 'has_disclaimer', 'disclaimer_file',
        'grade_upload_start_date', 'grade_upload_end_date', 'stage', 'status', 'course_type_id'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterCourse(){

        return $this->belongsTo('App\MasterCourse', 'master_course_id', 'id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modality(){

        return $this->belongsTo('App\CourseType', 'course_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requests(){

        return $this->belongsToMany('App\Teacher', 'course_requests',
                                            'course_id', 'teacher_id')
            ->withPivot('teacher_id', 'course_id', 'course_code', 'teacher_social_id', 'status')
            ->as('requests')
            ->withTimestamps();

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function university(){

        return $this->belongsTo('App\University', 'university_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrations(){
        return $this->hasMany('App\Registration', 'course_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvedRegistrations(){
        return $this->hasMany('App\Registration', 'course_id', 'id')
            ->where('is_approved', REGISTRATION_IS_APPROVED);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function diplomaUploadedBy(){

        return $this->belongsTo('App\User', 'diploma_uploaded_by_id', 'id');

    }


    public function getStageTitleAttribute(){

        return [
            'title' => ucfirst(getCourseStage($this->stage)),
            'class' => $this->stage == 0 ? 'default' : 'success'
        ];
    }

    public function getStatusTitleAttribute(){

        return [
            'title' => ucfirst(getCourseStatus($this->status)),
            'class' => $this->status == 0 ? 'default' : 'success'
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy(){

        return $this->belongsTo('App\User', 'updated_by', 'id');
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
        'grade_upload_start_date',
        'grade_upload_end_date',
    ];

    public static function parseYoutubeUrl($url)  {

        $pattern ='/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i';

        // Checks if it matches a pattern and returns the value
        if (preg_match($pattern, $url, $results)) {
            return $results[6];
        }
        // if no match return false.
        return false;
    }

    }

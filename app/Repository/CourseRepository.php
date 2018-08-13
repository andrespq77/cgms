<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 27/05/2018
     * Time: 2:23 PM
     */

namespace App\Repository;


use App\Course;
use App\Events\TeacherCreated;
use App\Registration;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class CourseRepository
 *
 * @package App\Repository
 */
class CourseRepository
{

    /**
     * @param $page
     * @return mixed
     */
    public function paginate($page){

        $data = Cache::tags('COURSE_PAGINATE')->remember('COURSE_PAGINATE_'.$page, 60, function ()  {

            return Course::with(['masterCourse', 'requests', 'university', 'registrations', 'approvedRegistrations',
                'updatedBy'])
                    ->orderBy('updated_at', 'desc')
                    ->orderBy('stage', 'asc')
                    ->orderBy('status', 'asc')
                    ->paginate(10);});

        return $data;

    }

    /**
     * @param $page
     * @param $universityId
     * @return mixed
     */
    public function coursesByUniversity($page, $universityId){

        $data = Cache::tags('COURSE_PAGINATE')->remember('COURSE_UNIVERSITY_'.$universityId.'__PAGINATE_'.$page, 60,
            function () use ($universityId)  {


            return Course::with(['masterCourse', 'requests', 'university', 'registrations', 'approvedRegistrations'])
                ->where('university_id', $universityId)
                ->paginate(10);

        });

        return $data;
    }

    /**
     * @param array $post
     * @return Course
     */
    public function insert($post){

        /**
         * Store a teacher and return the teacher
         */
        $user = Auth::user();
        $course = new Course();

        $course->master_course_id                   = $post['master_course_id'];

        $course->university_id                      = $post['university_id'];
        $course->course_code                        = $post['course_code'];
        $course->course_type_id                     = $post['course_type_id'];
        $course->short_name                         = $post['short_name'];
        $course->edition                            = $post['edition'];

        $course->start_date                         = $post['start_date'];
        $course->end_date                           = $post['end_date'];
        $course->year                               = $post['year'];

        $course->grade_upload_start_date            = $post['grade_upload_start_date'];
        $course->grade_upload_end_date              = $post['grade_upload_end_date'];

        $course->cost                               = $post['cost'];
        $course->finance_type                       = $post['finance_type'];
        $course->has_disclaimer                     = $post['is_disclaimer'];

        $course->hours                              = $post['hours'];
        $course->quota                              = $post['quota'];

        $course->stage                              = $post['stage'];
        $course->status                             = $post['status'];

        $course->comment                            = $post['comment'];
        $course->description                        = $post['description'];

        $course->video_text                         = $post['video_text'];
        $course->video_type                         = $post['video_type'];
        $course->video_code                         = $post['video_code'];

        $course->data_update_brief                  = $post['data_update_text'];
        $course->terms_conditions                   = $post['terms_conditions'];

        $course->inspection_form_generated          = false;

        $course->created_by                         = $user->id;
        $course->updated_by                         = $user->id;

        $course->save();

        $this->flushCache();

        return $course;

    }

    public function search($page, $keyword){

        $data = Cache::tags('COURSE_SEARCH')
            ->remember('COURSE_SEARCH_PAGINATE_'.$page.'_KEYWORD_'.str_slug( $keyword,'-'), 60,
                function () use($keyword) {

                    return Course::with(['masterCourse', 'requests', 'university', 'registrations', 'approvedRegistrations'])
                        ->where('course_code', 'like','%' . $keyword . '%')
                        ->orWhere('short_name','like', '%' . $keyword . '%')

                        ->orWhere('hours',(int) filter_var($keyword, FILTER_SANITIZE_NUMBER_INT))
                        ->orWhere('description','like', '%' . $keyword . '%')
                        ->paginate(10);

                });

        return $data;
    }

    /**
     * @param $social_id
     * @param $inst_email
     * @return bool
     */
    public function isTeacherExist($social_id, $inst_email){

        $teacher = Teacher::where([
            'social_id' => $social_id,
            'inst_email'    => $inst_email
        ])->count();

        if ($teacher > 0){
            return true;
        }

        return false;

    }


    /**
     * Update Grade and grade details
     *
     * @param string    $courseId
     * @param string    $student_social_id
     * @param float     $grade
     * @param integer   $approved
     * @param User      $user
     * @return mixed
     */
    public function updateGrade($courseId, $student_social_id, $grade, $approved, $user){

        $registration = Registration::where('course_id', $courseId)
                        ->where('user_social_id', $student_social_id)
                        ->first();

        if ($registration){

            //if the grade data is approve is zeror then reset all these fields if one then upgrade
            $registration->mark = $approved==0 ? null : $grade;
            $registration->mark_approved = $approved;
            $registration->mark_approved_by = $approved==0 ? null : $user->id;
            $registration->mark_upload_time = $approved==0 ? null : Carbon::now();
            $registration->save();

            return $registration;

        } else {
            return null;
        }


    }


    public function findById($id){

        $time = config('adminlte.cache_time');

        $course = Cache::tags(['COURSE_FIND_BY_ID'])->remember('COURSE_FIND_BY_ID_'.$id, $time, function () use($id){

            return Course::with(['requests', 'university', 'registrations', 'approvedRegistrations',
                'diplomaUploadedBy'])
            ->find($id);

        });

        return $course;

    }

    /**
     * Invalidate cache course
     * @param $id
     */
    public function flushById($id){

        Cache::tags(['COURSE_FIND_BY_ID'])->flush('COURSE_FIND_BY_ID_'.$id);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getById($id){

        return $this->findById($id);

    }

    /**
     * @param $code
     * @return mixed
     */
    public function findByCourseCode($code){

        $time = config('adminlte.cache_time');

        $course = Cache::tags(['COURSE_FIND_BY_CODE'])->remember('COURSE_FIND_BY_CODE_'.$code, $time, function () use($code){

            return Course::where('course_code', $code)->first();

        });

        return $course;


    }

    public function flushCache(){

        Cache::tags(['COURSE_FIND_BY_ID', 'COURSE_FIND_BY_CODE','COURSE_SEARCH'])->flush();
        Cache::tags(['COURSE_PAGINATE'])->flush();
    }

    /**
     * @param $id
     */
    public function invalidateCache($id){

        $this->flushById($id);

    }
}

<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 05/07/2018
     * Time: 5:45 PM
     */

namespace App\Repository;


use App\MasterCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class MasterCourseRepository
 *
 * @package App\Repository
 */
class MasterCourseRepository
{

    /**
     * @param $page
     */
    public function getListByPagination($page){

        $courses = Cache::tags(['MASTER_COURSE_LIST'])->remember('MASTER_COURSE_LIST_BY_PAGE_'.$page, 30, function (){

            return MasterCourse::orderBy('updated_at')
                    ->paginate(10);

        });

        return $courses;

    }


    public function getListAll(){


        $courses = Cache::tags(['MASTER_COURSE_LIST'])->remember('MASTER_COURSE_LIST_ALL', 30, function (){

            return MasterCourse::orderBy('name')
                ->get();

        });

        return $courses;

    }

    /**
     * @param $data
     * @return MasterCourse
     */
    public function insert($data){

        $user = Auth::user();
        $course = new MasterCourse();

        $course->name = $data['name'];
        $course->course_code = $data['course_code'];

        $course->type_id = @$data['type'];
        $course->label_id = @$data['label'];
        $course->sub_label_id = @$data['sublabel'];
        $course->knowledge_id = @$data['knowledge'];
        $course->subject_id = @$data['subject'];
     

        $course->created_by = $user->id;
        $course->updated_by = $user->id;

        $course->save();

        $this->flushCache();

        return $course;

    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id){

        $user = Auth::user();

        $course = $this->findById($id);

        $course->name = $data['name'];
        $course->course_code = $data['course_code'];

        $course->type_id = @$data['type'];
        $course->label_id = @$data['label'];
        $course->sub_label_id = @$data['sublabel'];
        $course->knowledge_id = @$data['knowledge'];
        $course->subject_id = @$data['subject'];

        $course->updated_by = $user->id;
        $course->save();

        $this->flushCache();

        return $course;


    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id){

        $master_course = $this->findById($id);
        $this->flushCache();

        if($master_course->courses->count()==0){
            return $master_course->delete();
        }
        else
            return false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id){

        $course = MasterCourse::find($id);

        return $course;

    }

    public function flushById($id){

    }

    public function flushCache(){

        Cache::tags(['MASTER_COURSE_LIST'])->flush();
    }

}
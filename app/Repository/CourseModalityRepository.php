<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 05/07/2018
     * Time: 1:18 PM
     */

namespace App\Repository;


use App\CourseModality;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class CourseModalityRepository
 *
 * @package App\Repository
 */
class CourseModalityRepository
{
    /**
     * @param $course_type_id
     */
    public function getListByCourseType($course_type_id){

        $types = Cache::tags(['MODALITY_LIST_BY_TYPE'])->remember('MODALITY_LIST_BY_TYPE_'.$course_type_id. 30,
            function () use($course_type_id){

                return CourseModality::with(['createdBy, updatedBy'])
                    ->where('course_type_id', $course_type_id)
                    ->orderBy('sort', 'asc')
                    ->get();

            });

        return $types;

    }


    /**
     * @param $data
     * @return CourseModality
     */
    public function insert($data){

        $user = Auth::user();
        $type = new CourseModality();
        $type->title = $data['title'];
        $type->course_type_id = $data['type_id'];
        $type->sort = $data['sort'];

        $type->created_by = $user->id;
        $type->updated_by = $user->id;
        $type->save();

        $this->flushCache();

        return $type;

    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id){

        $user = Auth::user();
        $type = $this->findById($id);

        $type->title = $data['title'];
        $type->course_type_id = $data['type_id'];
        $type->sort = $data['sort'];

        $type->updated_by = $user->id;

        $this->flushCache();

        return $type;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id){

        $type = $this->findById($id);

        $type->delete();

        return $type;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id){

        $type = CourseModality::find($id);

        return $type;
    }


    public function flushCache(){

        Cache::tags(['MODALITY_LIST_BY_TYPE'])->flush();
    }

}
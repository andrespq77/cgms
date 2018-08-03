<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 05/07/2018
     * Time: 12:59 PM
     */

namespace App\Repository;

use App\Course;
use App\CourseType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class CourseTypeRepository
 *
 * @package App\Repository
 */
class CourseTypeRepository
{

    public function getListByPagination($page = 1){

        $types = Cache::tags(['COURSE_TYPE_LIST'])->remember('COURSE_TYPE_LIST_ALL_BY_PAGE_'.$page, 20,
            function (){

            return CourseType::with(['course', 'createdBy', 'updatedBy'])
                    ->orderBy('sort', 'asc')
                    ->paginate(10);

            });

        return $types;


    }


    /**
     * @param bool $is_active
     */
    public function getAllList($is_active = true){

        $types = Cache::tags(['COURSE_TYPE_LIST'])->remember('COURSE_TYPE_LIST_ALL_BY_'.$is_active, 20,
            function () use($is_active){

            if ($is_active == true){

                return CourseType::where('is_active', $is_active)
                    ->orderby('sort', 'asc')
                    ->get();
            } else {

                return CourseType::orderby('sort', 'asc')
                    ->get();
            }

        });

        return $types;

    }

    /**
     * @param $data
     * @return CourseType
     */
    public function insert($data){

        $user = Auth::user();

        $type = new CourseType();
        $type->title = $data['title'];
        $type->is_active = isset($data['is_active']) ? $data['is_active'] : false;
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

        $type = $this->findById($id);
        $type->title = $data['title'];
        $type->is_active = isset($data['is_active']) ? $data['is_active'] : false;
        $type->sort = $data['sort'];

        $type->updated_by = Auth::user()->id;
        $type->save();

        $this->flushCache();

        return $type;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id){

        $type = CourseType::find($id);

        return $type;

    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id){

        $type = $this->findById($id);
        $type->delete();

        $this->flushCache();
        return true;

    }


    /**
     *
     */
    public function flushCache(){

        Cache::tags(['COURSE_TYPE_LIST'])->flush();
    }

}

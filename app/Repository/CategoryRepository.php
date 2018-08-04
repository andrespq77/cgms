<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 27/05/2018
     * Time: 2:23 PM
     */

namespace App\Repository;


use App\Category;
use App\Events\TeacherCreated;
use App\Registration;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class CategoryRepository
 *
 * @package App\Repository
 */
class CategoryRepository
{
    private $time;

    public function __construct()
    {

        $this->time = config('adminlte.cache_time');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll(){

        $data = Cache::tags(['CATEGORY_ALL'])->remember('CATEGORY_ALL', 60, function (){

            return Category::all();

        });

        return $data;
    }

    /**
     * @param array $post
     * @return Category
     */
    public function insert($post){

        /**
         * Store a teacher and return the teacher
         */

        $category = new Category();

        $category->title          = $post['title'];
        $category->type           = $post['type'];
        $category->label          = $post['label'];
        $category->sub_label      = $post['sub_label'];
        $category->knowledge      = $post['knowledge'];
        $category->subject        = $post['subject'];

        if(isset($post['parent_id'])){
            $category->parent_id        = $post['parent_id'];
        }

        if (app()->runningInConsole() == false){
            $category->created_by     = Auth::user()->id;
            $category->updated_by     = Auth::user()->id;
        } else {
            $category->created_by     = 1;
            $category->updated_by     = 1;
        }
        $category->save();

        $this->flushCategoryList();

        return $category;

    }

    /**
     * @param $post
     * @param $id
     * @return Category
     */
    public function update($post, $id){


        $category = $this->findById($id);

        $category->title          = $post['title'];
        $category->updated_by = Auth::user()->id;
        $category->save();

        $this->flushCategoryList();

        return $category;

    }


    /**
     *
     */
    public function getTypeList(){

        $categories = Cache::tags(['CATEGORY_TYPE_LIST'])->remember('CATEGORY_TYPE_LIST', $this->time, function (){

            return Category::where('type', 1)->get();

        });

        return $categories;

    }

    /**
     * @param $type
     * @param $id
     */
    public function getTypeListByParentId($type, $id){


        $categories = Cache::tags(['CATEGORY_TYPE_LIST'])
            ->remember('CATEGORY_TYPE_LIST_'.$type.'_ID_'.$id, $this->time, function () use($type, $id){

            return Category::where($type, 1)
                        ->where('parent_id', $id)
                        ->get();

        });

        return $categories;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id){

        $item = $this->findById($id);

        $result = $item->delete($id);

        if ($result){
            $this->flushCategoryList();
        }
        return $result;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function findById($id){

        $course = Cache::tags(['CATEGORY_FIND_BY_ID'])->remember('CATEGORY_FIND_BY_ID_'.$id, $this->time, function () use($id){

            return Category::find($id);

        });

        return $course;

    }

    /**
     * Invalidate cache course
     * @param $id
     */
    public function flushById($id){

        Cache::tags(['CATEGORY_FIND_BY_ID'])->flush('CATEGORY_FIND_BY_ID_'.$id);
    }


    /**
     *
     */
    public function flushCategoryList(){

        Cache::tags(['CATEGORY_TYPE_LIST'])->flush();
        Cache::tags(['CATEGORY_ALL'])->flush();


    }
}
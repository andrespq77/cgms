<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repository\CategoryRepository;
use App\Repository\MasterCourseRepository;
use Illuminate\Http\Request;

/**
 * Class MasterCourseController
 *
 * @package App\Http\Controllers
 */
class MasterCourseController extends Controller
{
    private  $repo ;
    private  $categoryRepo ;

    public function __construct()
    {
        $this->repo = new MasterCourseRepository();
        $this->categoryRepo = new CategoryRepository();
    }

    public function index(Request $request){

        $posts = $request->all();
        $page = isset($posts['page']) ? $posts['page'] : 1;
        $master_courses = $this->repo->getListByPagination($page);

        return view('lms.admin.master_course.index', ['masterCourses' => $master_courses, 'title'=> 'Master Courses']);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(){

        $list = $this->repo->getListAll();

        return response()->json(['master_course' => $list]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){


        $all = $this->categoryRepo->getAll();

        $category['type'] = $all->where('type', true);
        $category['labels'] = $all->where('label', true);
        $category['sub_labels'] = $all->where('sub_label', true);
        $category['knowledge'] = $all->where('knowledge', true);
        $category['subject'] = $all->where('subject', true);

        return view('lms.admin.master_course.create', ['category'=>$category ,'title'=> 'Master Course']);

    }

    /**
     * @todo add validation
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request){

        $post = $request->all();

        $type = $this->repo->insert($post);

        return response()->redirectTo(url('/admin/master-course'));


    }

    /**
     *
     * @todo add validation
     *
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id){

        $post = $request->all();

        $this->repo->update($post, $id);

        return response()->redirectTo(url('/admin/master-course'));


    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){

        $course = $this->repo->findById($id);
        $all = $this->categoryRepo->getAll();

        $category['type'] = $all->where('type', true);
        $category['labels'] = $all->where('label', true);
        $category['sub_labels'] = $all->where('sub_label', true);
        $category['knowledge'] = $all->where('knowledge', true);
        $category['subject'] = $all->where('subject', true);

        $tittle = __('lms.page.course.form.edit_title');
        return view('lms.admin.master_course.create', ['master' => $course, 'category' => $category,'title'=> $tittle]);


    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id){

        $this->repo->delete($id);

        return response()->redirectTo(url('/admin/master-course'));


    }
}

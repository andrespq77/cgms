<?php

namespace App\Http\Controllers;


use App\Repository\CourseTypeRepository;
use Illuminate\Http\Request;

class CourseTypeController extends Controller
{
    private  $repo ;

    public function __construct()
    {
        $this->repo = new CourseTypeRepository();
    }

    public function index(Request $request){


        $posts = $request->all();
        $page = isset($posts['page']) ? $posts['page'] : 1;
//        dd($page);
        $course_types = $this->repo->getListByPagination($page);

//        dd($course_types);
        return view('lms.admin.course_type.index', ['courseTypes' => $course_types, 'title'=> 'Course Types']);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(){

        $list = $this->repo->getAllList();

        return response()->json(['courseTypes' => $list]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){


        return view('lms.admin.course_type.create', [ 'title'=> 'Course Modality']);

    }

    public function insert(Request $request){

        $post = $request->all();

        $type = $this->repo->insert($post);

        return response()->redirectTo(url('/admin/course-modality'));


    }

    public function update(Request $request, $id){


        $post =$request->all();

        $data = $this->repo->update($post, $id);

        return response()->redirectTo(url('/admin/course-modality'));
    }


    public function show($id){

        $type = $this->repo->findById($id);

        return view('lms.admin.course_type.create', ['type' => $type, 'title'=> 'Edit Course']);


    }

    public function delete($id){

        $this->repo->delete($id);

        return response()->redirectTo(url('/admin/course-modality'));


    }
}

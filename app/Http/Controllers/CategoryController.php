<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    private  $repo;

    public function __construct()
    {
        $this->repo = new CategoryRepository();

    }

    public function index(){

        $all = $this->repo->getAll();

        $category['type'] = $all->where('type', true);

        return view('lms.admin.category.create', [ 'title'=> 'Category', 'category' => $category]);

    }

    public function getTypeList(){

        $all = $this->repo->getAll();
        $labels = $all->where('type', true);

        return response()->json(['types' => $labels]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postType(Request $request){

        $post = $request->all();

        $data['title'] = $post['title'];
        $data['type'] = true;
        $data['label'] = false;
        $data['sub_label'] = false;
        $data['knowledge'] = false;
        $data['subject'] = false;
        $data['parent_id'] = 0;

        $this->repo->insert($data);

        return response()->redirectTo(url('/admin/categories/type'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function label(){

        $all = $this->repo->getAll();

        $category['type'] = $all->where('type', true);
        $category['labels'] = $all->where('label', true);

        return view('lms.admin.category.create', [ 'title'=> 'Label', 'category' => $category]);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLabelList($id){

        $all = $this->repo->getAll();

        $labels = $all->where('label', true)
                            ->where('parent_id', $id);


        return response()->json(['labels' => $labels]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function postLabel(Request $request){

        $post = $request->all();

        $data['title'] = $post['title'];
        $data['type'] = false;
        $data['label'] = true;
        $data['sub_label'] = false;
        $data['knowledge'] = false;
        $data['subject'] = false;
        $data['parent_id'] = (int)$post['type'];

        $this->repo->insert($data);

        return response()->redirectTo(url('/admin/categories/label'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subLabel(){

        $all = $this->repo->getAll();

        $category['type'] = $all->where('type', true);
        $category['labels'] = $all->where('label', true);
        $category['sub_labels'] = $all->where('sub_label', true);

        return view('lms.admin.category.create', [ 'title'=> 'Sub Label', 'category' => $category]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubLabelList($id){

        $all = $this->repo->getAll();

        $labels = $all->where('sub_label', true)
            ->where('parent_id', $id);


        return response()->json(['labels' => $labels]);

    }

    /**
     * @param Request $request
     * @return $this
     */
    public function postSubLabel(Request $request){

        $post = $request->all();

        $data['title'] = $post['title'];
        $data['type'] = false;
        $data['label'] = false;
        $data['sub_label'] = true;
        $data['knowledge'] = false;
        $data['subject'] = false;
        $data['parent_id'] = $post['label'];

        $this->repo->insert($data);

        return response()->redirectTo(url('/admin/categories/sublabel'));

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function knowledge(){

        $all = $this->repo->getAll();

        $category['type'] = $all->where('type', true);
        $category['labels'] = $all->where('label', true);
        $category['sub_labels'] = $all->where('sub_label', true);
        $category['knowledges'] = $all->where('knowledge', true);

        return view('lms.admin.category.create', [ 'title'=> 'Area of Knowledge', 'category' => $category]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getKnowledgeList($id){

        $all = $this->repo->getAll();

        $labels = $all->where('knowledge', true)
            ->where('parent_id', $id);


        return response()->json(['labels' => $labels]);

    }

    /**
     * @param Request $request
     * @return $this
     */
    public function postKnowledge(Request $request){

        $post = $request->all();

        $data['title'] = $post['title'];
        $data['type'] = false;
        $data['label'] = false;
        $data['sub_label'] = false;
        $data['knowledge'] = true;
        $data['subject'] = false;
        $data['parent_id'] = $post['sublabel'];

        $this->repo->insert($data);

        return response()->redirectTo(url('/admin/categories/knowledge'));

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subject(){

        $all = $this->repo->getAll();

        $category['type'] = $all->where('type', true);
        $category['labels'] = $all->where('label', true);
        $category['sub_labels'] = $all->where('sub_label', true);
        $category['knowledges'] = $all->where('knowledge', true);
        $category['subjects'] = $all->where('subject', true);

        return view('lms.admin.category.create', [ 'title'=> 'Subject', 'category' => $category]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubjectList($id){

        $all = $this->repo->getAll();

        $labels = $all->where('subject', true)
            ->where('parent_id', $id);


        return response()->json(['labels' => $labels]);

    }

    /**
     * @param Request $request
     * @return $this
     */
    public function postSubject(Request $request){

        $post = $request->all();

        $data['title'] = $post['title'];
        $data['type'] = false;
        $data['label'] = false;
        $data['sub_label'] = false;
        $data['knowledge'] = false;
        $data['subject'] = true;
        $data['parent_id'] = $post['knowledge'];

        $this->repo->insert($data);

        return response()->redirectTo(url('/admin/categories/subject'));

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function insert(Request $request){

        $post = $request->all();


        $category = null;

        if ($post['type'] == 'type'){

            $data['title'] = $post['title'];
            $data['type'] = true;
            $data['label'] = false;
            $data['sub_label'] = false;
            $data['knowledge'] = false;
            $data['subject'] = false;

            $category = $this->repo->insert($data);

        }


        return response()->json(['data' => $category])->setStatusCode(201);

    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){


        $posts = $request->all();
        $result = $this->repo->update($posts, $id);

        return response()->json(['data', $result]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){
        $this->repo->delete($id);

        return response()->json([])->setStatusCode(204);
    }

    /**
     * @return mixed
     */
//    public function getTypeList(){
//
//        return $this->repo->getTypeList();
//    }

    /**
     * @param $type
     * @param $parent_id
     * @return mixed
     */
    public function getListByType($type, $parent_id){

        return $this->getListByType($type, $parent_id);

    }

}

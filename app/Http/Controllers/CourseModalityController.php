<?php

namespace App\Http\Controllers;

use App\Repository\CourseModalityRepository;
use Illuminate\Http\Request;

class CourseModalityController extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = new CourseModalityRepository();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function insert(Request $request){
        $data = $request->all();

        $result = $this->repo->insert($data);

        return response()->json(['modality' => $result] )->setStatusCode(201);
    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){

        $data = $request->all();

        $result = $this->repo->update($data, $id);

        return response()->json(['modality' => $result] )->setStatusCode(200);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function delete($id){

        $this->repo->delete($id);

        return response()->json([])->setStatusCode(204);

    }

}

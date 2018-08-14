<?php

namespace App\Http\Controllers;

use App\Events\UniversityCreated;
use App\University;
use Illuminate\Http\Request;
use App\Province;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Canton;

/**
 * Class UniversityController
 *
 * @package App\Http\Controllers
 */
class UniversityController extends Controller
{
    public function index(){
        
        $title = 'University Management - '.env('APP_NAME') ;
        return view('lms.admin.university.index', ['title'=> $title]);

    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUniversityList(){

        $universities = University::all();
        return response()->json(['universities' => $universities]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTableData()
    {

        $universities = University::select([
            'universities.id as id',
            'universities.name as name',
            'universities.email as email',
            'universities.website as website',
            'universities.phone as phone',
            'universities.note as note',
            'universities.login_email as login_email',
            'universities.login_user_name as login_user_name',
            'universities.created_by as created_by_id',
            'users.name as created_by_name',
            'universities.created_at as created_at',
            ])
            ->join('users','universities.created_by', '=' ,'users.id')
            ->orderBy('universities.created_at', 'desc');

        return Datatables::of($universities)
            ->editColumn('action', 'lms.admin.university.action')
            ->setRowId(function ($universities){
                return 'university_id_'.$universities->id;
            })
            ->make(true);

    }


    /**
     * @todo add validation rule
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){

        $university = new University();

        $post = $request->all();

        $university->name           = $post['name'];
        $university->email          = $post['email'];
        $university->login_email    = $post['login_email'];
        $university->login_user_name= $post['login_name'];
        $university->website        = $post['website'];
        $university->phone          = $post['phone'];
        $university->note           = $post['note'];
        $university->name           = $post['name'];
        $university->created_by        = Auth::user()->id;
        $university->updated_by        = Auth::user()->id;
        $university->save();

        /**
         * create user and update university with user_id
         */
        event(new UniversityCreated($university, $post['login_password'], Auth::user()));


        return response()->json(['university' => $university])->setStatusCode(201);
    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){

        $university = University::find($id);

        if ($university){

            $post = $request->all();

            $university->name           = $post['name'];
            $university->email          = $post['email'];
            $university->website        = $post['website'];
            $university->phone          = $post['phone'];
            $university->note           = $post['note'];

            $university->updated_by     = Auth::user()->id;
            $university->save();

            return response()->json(['university' => $university])->setStatusCode(200);
        } else{

            return response()->json(['error' => 'Not found'])->setStatusCode(404);
        }


    }

    public function view($id){

        $university = University::find($id);

        $title = $university->name.' - '.env('APP_NAME') ;

        return view('lms.admin.university.view', ['title'=> $title,
            'university' => $university]);



    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

        $university = University::findOrFail($id);
        $university->delete();

        return response()->json()->setStatusCode(204);

    }

    /**
     * @param $id
     */
    public function uploadMark($id){

        $user = Auth::user();
        $university = University::find($id);

        if ($user->can('uploadmark', $university )){

            echo  'allowed';

        } else{

            echo  'deni';

        }


    }

}

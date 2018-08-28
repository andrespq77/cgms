<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{


    public function index(){

        $title = 'User Management - '. env('APP_NAME');
        return view('lms.admin.user.index',
            ['title' => $title]);

    }


    public function getTableData(){
        return Datatables::of(User::query())
            ->editColumn('action', 'lms.admin.user.action')
            ->setRowId(function ($users){
                return 'user_id_'.$users->id;
            })
            ->make(true);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){

        $user = new User();

        $post = $request->all();

        $role = array_keys(USER_ROLE, $post['role']);
        $status = array_keys(USER_STATUS, $post['status']);

        $user->name             = $post['name'];
        $user->email            = $post['email'];
        $user->role             = $role[0];
        $user->status           = $status[0];
        $user->password         = bcrypt($post['email']);
        $user->creation_type    = USER_CREATION_TYPE_CMS;
        $user->save();

        return response()->json(['user' => $user])->setStatusCode(201);

    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){

        $user = User::find($id);

        if ($user){

            $post = $request->all();

            $user->name     = $post['name'];
            $user->email    = $post['email'];
            $user->status   = $post['status'] == 'active' ? USER_STATUS_ACTIVE : USER_STATUS_INACTIVE;
            $user->save();

            return response()->json(['user' => $user])->setStatusCode(200);


        }

        return response()->json(['message' => 'User not found'])->setStatusCode(404);

    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request, $id){

        $v = $this->validate($request, [
            'password' => 'required|max:20|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
        ]);

        if ($v){

            $user = User::find($id);
            if ($user){

                $post = $request->all();

                $user->password    = bcrypt($post['password']);
                $user->save();

                return response()->json(['user' => $user])->setStatusCode(200);

            }

        } else {

            return response()->json(['error' => $v->getMessage()])->setStatusCode(422);

        }


        return response()->json(['message' => 'User not found'])->setStatusCode(404);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){


        $user = User::findOrFail($id);
        $user->delete();

        return response()->json()->setStatusCode(204);

    }

    public function updateStatus(){

    }

}

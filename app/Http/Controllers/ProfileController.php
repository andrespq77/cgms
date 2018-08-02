<?php

namespace App\Http\Controllers;

use App\Repository\TeacherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{


    public function index(){


        $title = 'Profile '.env('APP_NAME') ;

        if (Auth::user()->role == 'teacher'){

            return view('lms.admin.profile.teacher_profile', ['title'=> $title, 'teacher'=> Auth::user()->teacher]);
        } else{
            return view('lms.admin.profile.account', ['title'=> $title]);
        }

    }

    public function changePassword(){


        $title = 'Change Password '.env('APP_NAME') ;

        return view('lms.admin.profile.password', ['title'=> $title]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request){


        $v = $this->validate($request, [
            'password' => 'required|max:20|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
        ]);

        if ($v){

            $posts  = $request->all();

            $user = Auth::user();

            $user->password = bcrypt($posts['password']);
            $user->save();

            return redirect()->back()->with('message', 'Password Changed');


            // update password
        } else {


            return redirect()->back()->withErrors($v)->withInput();

        }

    }


    /**
     *
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){

        $user = Auth::user();

        $v = null;

        if ($user->role == 'teacher'){

            $v = $this->validate($request, [
                'phone2' => 'required|max:100|min:3|string',
                'email2' => 'required|email|max:100|min:3|string'
            ]);


            if ($v){

                $teacherRepo = new TeacherRepository();

                $teacher = $teacherRepo->findById($user->teacher->id);

                $teacher->phone2 = $request->input('phone2');
                $teacher->email2 = $request->input('email2');
                $teacher->save();

                $teacherRepo->flushCacheById($user->teacher->id);

                return redirect()->back()->with('message', 'Updated');

                // update password
            }

        } else {

            $v = $this->validate($request, [
            'name' => 'required|max:100|min:3|string'
            ]);


            if ($v){

                $posts  = $request->all();
                $user = Auth::user();

                $user->name = $posts['name'];
                $user->save();

                return redirect()->back()->with('message', 'Updated');

                // update password
            }

        }

        return redirect()->back()->withErrors($v)->withInput();


    }

    public function updateEmail(Request $request){


        $v = $this->validate($request, [
            'email' => 'required|max:100|min:3|email|unique:users,email'
        ]);

        if ($v){

            $posts  = $request->all();
            $user = Auth::user();

            $user->email = $posts['email'];
            $user->save();

            return redirect()->back()->with('message_email', 'Login Email Updated');


            // update password
        } else {


            return redirect()->back()->withErrors($v)->withInput();

        }

    }


    public function restPassword(){

    }
}

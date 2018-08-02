<?php

namespace App\Http\Controllers\Auth;

use App\Teacher;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
//        @todo register validation for new
//        dd($data);
        return Validator::make($data, [
            'full_name' => 'required|string|max:255|min:2',
            'email'     => 'required|string|email|max:255|unique:users',
            'social_id' => 'required|string|max:30|unique:teachers',
            'amie'      => 'required|string|max:50',
            'canton'    => 'nullable|sometimes|sometimes|string|max:100',
            'work_area' => 'nullable|sometimes|string|max:100',
            'password'  => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['full_name'],
            'email' => $data['email'],
            'role'  => USER_ROLE_STUDENT,
            'status' => USER_STATUS_ACTIVE,
            'creation_type' => USER_CREATION_TYPE_REGISTRATION,
            'password' => Hash::make($data['password']),
        ]);

        $teacher = new Teacher();
        $teacher->first_name = $user->name;
        $teacher->last_name = '';
        $teacher->social_id = $data['social_id'];
        $teacher->amie = $data['amie'];
        $teacher->inst_email = $data['email'];
        $teacher->canton = $data['canton'];
//        $teacher->date_of_birth = $data['dob'];
        $teacher->work_area = $data['work_area'];

        $teacher->user_id = $user->id;
        $teacher->created_by = $user->id;
        $teacher->updated_by = $user->id;

        $teacher->save();

        return $user;


    }
}

<?php
/**
 * Created by PhpStorm.
 * User: ZEUS
 * Date: 8/1/2018
 * Time: 9:37 PM
 */

namespace App\Http\Controllers\Auth;
use App\Repository\TeacherRepository;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;

class LdapAccessController extends Controller
{

    private $repo = null;

    public function __construct()
    {
        $this->repo = new TeacherRepository();
    }

    public function index() {
        return view('auth.students.login');
    }

    protected function validateLogin(Request $request) {
        $this->validate($request, [
            'username' => 'required|string|regex:/^\w+$/',
            'password' => 'required|string',
        ]);
    }

    public function login(Request $request) {

        try {

            $credentials = $request->only('username', 'password');
            $username = $credentials['username'];
            $password = $credentials['password'];

            $ldap_user = isValidLdapCreds($username ,$password);

            if($ldap_user) {
                // the user exists in the LDAP server, with the provided password

                $name = isset($ldap_user[0]['cn'][0]) ? $ldap_user[0]['cn'][0] : $username;
                $email = isset($ldap_user[0]['userprincipalname'][0]) ? $ldap_user[0]['userprincipalname'][0] : $username ;

                $first_name = isset($ldap_user[0]['givenname'][0]) ? $ldap_user[0]['givenname'][0] : $username;
                $last_name = isset($ldap_user[0]['sn'][0]) ? $ldap_user[0]['sn'][0] : $username;
                $social_id = isset($ldap_user[0]['usnchanged'][0]) ? $ldap_user[0]['usnchanged'][0] : $username;

                $userTeacherExist = $this->repo->isTeacherExistWithSocialId($social_id);

                if($userTeacherExist){

                    $user = $this->repo->findTeacherUserWithSocialId($social_id);
                }

                else
                {
                    $user = new \App\User();
                    $user->username = $username;
                    $user->password = bcrypt($password);
                    $user->name = $name;
                    $user->role = 3;
                    $user->username = $username;
                    $user->email = $email;
                    $user->save();

                    $teacher = new \App\Teacher();
                    $teacher->first_name = $first_name;
                    $teacher->last_name = $last_name;
                    $teacher->user_id = $user->id;
                    $teacher->social_id = $social_id;
                    $teacher->created_by = 1;
                    $teacher->updated_by = 1;
                    $teacher->save();

                }


              Auth::login($user);

                $request->session()->put('logged', $username);
                session()->flash('app_message', 'Successfully logged in from the LDAP');

                return redirect('/admin/portfolio');

            }


            session()->flash('app_error', 'Credentials are invalid please try again');

            return redirect(url('/students/login'));


        } catch (\Exception $e) {
            session()->flash('app_error', 'Can\'t contact to LDAP server.');
            return back();
        }


    }

}
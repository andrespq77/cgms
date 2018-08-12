<?php
/**
 * Created by PhpStorm.
 * User: ZEUS
 * Date: 8/1/2018
 * Time: 9:37 PM
 */

namespace App\Http\Controllers\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;

class LdapAccessController extends Controller
{
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

		} catch (\Exception $e) {
            session()->flash('app_error', 'Can\'t contact to LDAP server.');
            return back();
        }
		
		$credentials = $request->only('username', 'password');
        $username = $credentials['username'];
        $password = $credentials['password'];

        $ldap_user_moodle = isValidLdapCreds($username ,$password);

        dd($ldap_user_moodle);

        if($ldap_user_moodle) {
            // the user exists in the LDAP server, with the provided password

            $user = \App\User::where('username', $username)->first();

            if (!$user) {

                $ldap_user = Adldap::search()->where('samaccountname', '=', $username)->first();

                if(!is_null($ldap_user)){

                    $user = new \App\User();
                    $user->username = $username;
                    $user->password = bcrypt($password);
                    $user->name = $ldap_user->cn;
                    $user->username = $ldap_user->username;
                    $user->email = $ldap_user->email;
                    $user->save();

                    $teacher = new \App\Teacher();
                    $teacher->first_name = $ldap_user->cn;
                    $teacher->last_name = $ldap_user->c;
                    $teacher->user_id = $user->id;
                    $teacher->social_id = $ldap_user->usnchanged;
                    $teacher->created_by = 1;
                    $teacher->updated_by = 1;
                    $teacher->save();


                    Auth::login($user);

                }

            }


            $request->session()->put('logged', $username);

            return redirect('/students');

        }


        session()->flash('app_error', 'Credentials are invalid please try again');

        return redirect(url('/students/login'));
    }

}
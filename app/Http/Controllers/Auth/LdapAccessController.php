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
	
	public function username() {
        return config('adldap_auth.usernames.eloquent');
    }


    protected function validateLogin(Request $request) {
        $this->validate($request, [
            $this->username() => 'required|string|regex:/^\w+$/',
            'password' => 'required|string',
        ]);
    }

    public function login(Request $request) {

		try {

			Adldap::connect();

		} catch (\Exception $e) {
            session()->flash('app_error', 'Can\'t contact to LDAP server.');
            return back();
        }
		
		$credentials = $request->only($this->username(), 'password');
        $username = $credentials[$this->username()];
        $password = $credentials['password'];


//        $user = Adldap::search()->users()->find('Mariana Intriago')->first();
//        $search = Adldap::search()->where('samaccountname', '=', 'maria.intriago')->first();
//		  $user = Adldap::search()->users()->find($credentials[$this->username()]);

        $user_format = env('ADLDAP_USER_FORMAT', 'cn=%s,'.env('ADLDAP_BASEDN', ''));
        $userdn = sprintf($user_format, $username);
        
        if(Adldap::auth()->attempt($username, $password)) {
            // the user exists in the LDAP server, with the provided password

            $user = \App\User::where($this->username(), $username)->first();

            if (!$user) {

                // the user doesn't exist in the local database, so we have to create one

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

                }

            }

            Auth::login($user);

            $request->session()->put('logged', $username);

            return redirect('/students');

        }

        session()->flash('app_error', 'Credentials are invalid please try again');

        return redirect(url('/students/login'));
    }

}
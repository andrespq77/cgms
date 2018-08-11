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

//		$user = Adldap::search()->users()->find($credentials[$this->username()]);
		$users = Adldap::search()->count();
		dd($users);
		foreach ($users as $user){
            dd($user);
        }


        if(Adldap::auth()->attempt($username, $password, $bindAsUser = true)) {
            // the user exists in the LDAP server, with the provided password

            $user = \App\User::where($this->username(), $username)->first();

            if (!$user) {
                // the user doesn't exist in the local database, so we have to create one

                $user = new \App\User();
                $user->username = $username;
                $user->password = '';

                // you can skip this if there are no extra attributes to read from the LDAP server
                // or you can move it below this if(!$user) block if you want to keep the user always
                // in sync with the LDAP server
                $sync_attrs = $this->retrieveSyncAttributes($username);
                foreach ($sync_attrs as $field => $value) {
                    $user->$field = $value !== null ? $value : '';
                }
            }

            Auth::login($user);

            $request->session()->put('logged', $username);

            return redirect('/students');

        }

        session()->flash('app_error', 'Credentials are invalid please try again');

        return redirect(url('/students/login'));
    }


    protected function retrieveSyncAttributes($username) {

//        Remember that you have these users available in the testing LDAP server: riemann, gauss, euler, euclid, einstein, newton, galieleo and tesla. The password is password for all of them.

        $attrs = [];

        $ldapuser = Adldap::search()->where(env('ADLDAP_USER_ATTRIBUTE'), '=', $username)->first();
        if ( !$ldapuser ) {
            // log error
            return $attrs;
        }
        // if you want to see the list of available attributes in your specific LDAP server:
        // dd($ldapuser->attributes); exit;

        // needed if any attribute is not directly accessible via a method call.
        // attributes in \Adldap\Models\User are protected, so we will need
        // to retrieve them using reflection.
        $ldapuser_attrs = null;


        foreach (config('adldap_auth.sync_attributes') as $local_attr => $ldap_attr) {

            if ( $local_attr == 'username' ) {
                continue;
            }

            $method = 'get' . $ldap_attr;
            if (method_exists($ldapuser, $method)) {
                $attrs[$local_attr] = $ldapuser->$method();
                continue;
            }

            if ($ldapuser_attrs === null) {
                $ldapuser_attrs = self::accessProtected($ldapuser, 'attributes');
            }

            if (!isset($ldapuser_attrs[$ldap_attr])) {
                // an exception could be thrown
                $attrs[$local_attr] = null;
                continue;
            }

            if (!is_array($ldapuser_attrs[$ldap_attr])) {
                $attrs[$local_attr] = $ldapuser_attrs[$ldap_attr];
            }

            if (count($ldapuser_attrs[$ldap_attr]) == 0) {
                // an exception could be thrown
                $attrs[$local_attr] = null;
                continue;
            }

            // now it returns the first item, but it could return
            // a comma-separated string or any other thing that suits you better
            $attrs[$local_attr] = $ldapuser_attrs[$ldap_attr][0];
            //$attrs[$local_attr] = implode(',', $ldapuser_attrs[$ldap_attr]);
        }

        return $attrs;
    }

    protected static function accessProtected ($obj, $prop) {

        $reflection = new \ReflectionClass($obj);
        $property = $reflection->getProperty($prop);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}
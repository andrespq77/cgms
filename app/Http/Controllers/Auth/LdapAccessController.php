<?php
/**
 * Created by PhpStorm.
 * User: ZEUS
 * Date: 8/1/2018
 * Time: 9:37 PM
 */

namespace App\Http\Controllers\Auth;
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

    public function login(Request $request) {
		
		try {
			Adldap::connect();
			//on local through exception
		} catch (\Exception $e) {
			dd('can not connect to ldap');
		}
		
		$credentials = $request->only($this->username(), 'password');
        $username = $credentials[$this->username()];
        $password = $credentials['password'];
		
		$user_format = env('ADLDAP_USER_FORMAT', 'cn=%s,'.env('ADLDAP_BASEDN', ''));
        $userdn = sprintf($user_format, $username);
		
		//$user = Adldap::search()->users()->find($credentials[$this->username()]);
		//dd($user);

        if(Adldap::auth()->attempt($username, $password)) {
			$request->session()->put('logged', $username);
			return redirect('/students');
        }
        return redirect(url('/students/login'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Adldap\AdldapInterface;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    protected $ldap;

    public function __construct(AdldapInterface $ldap)
    {
        $this->middleware('ldapauth');
        $this->ldap = $ldap;
        App::setLocale(env('LANGUAGE', 'en'));

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		//if (Auth::check()){
			
            // $user = Auth::user()->toArray();
			$user = User::where('email', $request->session()->get('logged'))->first();
            
            if ($user['role'] == 'teacher') {
                return redirect(url('/admin/portfolio'));
            } else {
                return view('home');
            }

        //} else{
          //  return response()->redirectTo(url('login'));
        //}
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unauthorized(){

        return view('lms.admin.error.403');
    }
}

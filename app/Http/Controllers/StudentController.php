<?php
/**
 * Created by PhpStorm.
 * User: ZEUS
 * Date: 8/2/2018
 * Time: 5:38 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        return view('students.page');
    }
}
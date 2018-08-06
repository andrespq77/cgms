<?php
    /**
     * Created by PhpStorm.
     * User: ariful.haque
     * Date: 27/05/2018
     * Time: 2:23 PM
     */

namespace App\Repository;


use App\University;
use Illuminate\Support\Facades\Auth;

/**
 * Class UniversityRepository
 *
 * @package App\Repository
 */
class UniversityRepository
{

    /**
     * @param array $post
     * @return University
     */
    public function insert($post){

        /**
         * Store a teacher and return the teacher
         */

        $university = new University();

        $university->name               = $post['name'];
        $university->email              = $post['email'];

        $university->login_email        = $post['login_email'];
        $university->login_user_name    = $post['login_user_name'];

        $university->website            = $post['website'];
        $university->phone              = $post['phone'];
        $university->note               = $post['phone'];

        $university->created_by         = Auth::user()->id;
        $university->updated_by         = Auth::user()->id;
        $university->save();

//        add user of the teacher
//        event(new TeacherCreated($newCourse, $creation_type, $creation_type));

        return $university;

    }

    /**
     * @param $name
     * @return null
     */
    public function getUniversityByName($name){

        $university = University::where('name', $name)->first();


        if ($university){
            return $university;

        }

        return null;

    }


}
<?php

namespace App\Policies;

use App\Course;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CoursePolicy
 *
 * @package App\Policies
 */
class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Only admin and university can browse course
     *
     * @param User   $user
     * @return bool
     */
    public function browse(User $user){


        if($user->role == 'teacher'){
            return false;
        }

        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user){

        if ($user->role == 'admin'){

            return true;
        }

        return false;
    }

    public function update(User $user){

        if ($user->role == 'admin'){

            return true;
        }

        return false;
    }



    /**
     * @param User $user
     * @return bool
     */
    public function upcoming(User $user){

        if ($user->role == 'teacher'){

            return true;
        }

        return false;
    }

    /**
     * Only admin can delete a course.
     * Course owner can't delete the course
     *
     * @param User   $user
     * @param Course $course
     * @return bool
     */
    public function delete(User $user, Course $course){



        if ($user->role == 'admin'){

            return true;
        }

        return false;

    }


    /**
     * Only owner of the course can add mark. Admin cant add mark
     *
     * @param User   $user
     * @param Course $course
     * @return bool
     */
    public function addmark(User $user, Course $course){

        if (($user->role == 'university' && $user->id == $course->university->user_id ) || $user->role == 'admin'){

            return true;
        }

        return false;
    }

    /**
     * @param User   $user
     * @param Course $course
     * @return bool
     */
    public function update_grade(User $user, Course $course){


        if ($user->role == 'university' &&
            $user->id == $course->university->user_id ){

            return true;
        }

        return false;

    }


    /**
     * @param User   $user
     * @param Course $course
     * @return bool
     */
    public function upload_diploma(User $user, Course $course){


        if ( (  $user->role == 'university' && $user->id == $course->university->user_id ) ||
                $user->role == 'admin'){

            return true;

        } else{

            return false;
        }

    }

    public function register(User $user, Course $course){

        if ($user->role == 'teacher'){

            return true;

        } else{

            return false;

        }

    }

}

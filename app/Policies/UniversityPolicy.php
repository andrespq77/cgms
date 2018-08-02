<?php

namespace App\Policies;

use App\Registration;
use App\University;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UniversityPolicy
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

    public function uploadmark(User $user, University $university){

        /**
         * If logged in user and university user is same , allow
         */
        if ($user->role == 'university' &&
            $user->id == $university->user_id) {

            return true;
        } else {
            return false;
        }

    }


    /**
     * Only Admin can delete a university
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user){

        if ($user->role == 'admin'){

            return true;

        } else{
            return false;
        }

    }

    public function addmark(User $user, University $university){

        /**
         * If logged in user and university user is same , allow
         */
        if ($user->role == 'university' &&
            $user->id == $university->user_id) {

            return true;
        } else {
            return false;
        }

    }
}

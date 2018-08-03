<?php

namespace App\Policies;

use App\Registration;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistrationPolicy
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
     * @param User         $user
     * @param Registration $registration
     * @return bool
     */
    public function approve_registration(User $user, Registration $registration){


        if ($user->role == 'admin'){

            return true;

        } else{

            return false;

        }

    }

}

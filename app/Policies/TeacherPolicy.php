<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TeacherPolicy
 *
 * @package App\Policies
 */
class TeacherPolicy
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


    public function browse(User $user){

        if ($user->role == 'admin'){

            return true;
        }

        return false;
    }

    public function create(User $user){

        if ($user->role == 'admin'){

            return true;
        }

        return false;

    }

    public function edit(User $user){

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


    public function delete(User $user){

        if ($user->role == 'admin'){

            return true;
        }

        return false;

    }

    public function view(){

    }
}

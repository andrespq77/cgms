<?php

namespace App\Listeners;

use App\Events\UniversityCreated;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class CreateUniversityUser
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param UniversityCreated $universityCreated
     * @return void
     */
    public function handle(UniversityCreated $universityCreated)
    {

        $user = new User();
        $user->name = $universityCreated->university->login_user_name;
        $user->email = $universityCreated->university->login_email;
        $user->password = bcrypt($universityCreated->password);
        $user->role = USER_ROLE_UNIVERSITY;
        $user->status = USER_STATUS_ACTIVE;
        $user->creation_type = USER_CREATION_TYPE_REGISTRATION;

        $user->created_by = $universityCreated->user->id;
        $user->updated_by = $universityCreated->user->id;

        $user->save();

        $universityCreated->university->user_id = $user->id;
        $universityCreated->university->save();

    }
}

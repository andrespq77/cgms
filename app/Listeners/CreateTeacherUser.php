<?php

namespace App\Listeners;

use App\Events\TeacherCreated;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

/**
 * Class CreateTeacherUser
 *
 * @package App\Listeners
 */
class CreateTeacherUser
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param TeacherCreated|object $event
     * @return void
     */
    public function handle(TeacherCreated $event)
    {

        $user = User::where('email' , $event->teacher->email)->first();

        if(!$user){
            $user = new User();
            $user->password = bcrypt($event->teacher->email);
        }

        $user->name = $event->teacher->first_name . ' '.$event->teacher->last_name ;
        $user->email = $event->teacher->email;

        $user->role = USER_ROLE_STUDENT;
        $user->status = USER_STATUS_ACTIVE;
        $user->creation_type = $event->creation_type;
        $user->created_by = Auth::user()->id;
        $user->updated_by = Auth::user()->id;
        $user->save();

        $event->teacher->user_id = $user->id;
        $event->teacher->save();

    }
}

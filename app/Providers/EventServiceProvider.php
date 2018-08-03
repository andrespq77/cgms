<?php

namespace App\Providers;

use Illuminate\Auth\Events\Logout;
use App\Events\DiplomaUploaded;
use App\Events\RegistrationApproved;
use App\Events\TeacherCreated;
use App\Events\UniversityCreated;
//use App\Listeners\AddTeacherUser;
use App\Listeners\CreateTeacherUser;
use App\Listeners\CreateUniversityUser;
use App\Listeners\ExtractDiplomaFile;
use App\Listeners\GenerateInspectionCertificate;
use App\Listeners\UserLogoutListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        TeacherCreated::class => [
            CreateTeacherUser::class
        ],

        RegistrationApproved::class => [
            GenerateInspectionCertificate::class,
        ],

        UniversityCreated::class => [
            CreateUniversityUser::class
        ],
        DiplomaUploaded::class => [
            ExtractDiplomaFile::class
        ],
        Logout::class => [
          UserLogoutListener::class
        ]
//        'Illuminate\Auth\Events\Logout' => [
//            'App\Listeners\UserLoggedOut',
//        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

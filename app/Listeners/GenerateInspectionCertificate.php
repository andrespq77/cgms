<?php

namespace App\Listeners;

use App\Events\RegistrationApproved;
use App\Repository\RegistrationRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

/**
 * Class GenerateInspectionCertificate
 *
 * @package App\Listeners
 */
class GenerateInspectionCertificate
{
    private  $repo ;
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        $this->repo = new RegistrationRepository();
    }

    /**
     * Handle the event.
     *
     * @param RegistrationApproved $approved
     * @return void
     * @internal param object $event
     */
    public function handle(RegistrationApproved $approved)
    {
        //@todo generate file and update the registration

        $this->repo->generateInspectionCertificate($approved->registration);;

    }
}

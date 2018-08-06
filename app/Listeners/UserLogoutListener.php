<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Class UserLogoutListener
 *
 * @package App\Listeners
 */
class UserLogoutListener
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
     * @param Logout|object $event
     * @return void
     */
    public function handle(Logout $event)
    {

        Cache::forget('auth_user');
        Cache::flush();

        Log::info('Clearing all cache on Logout', ['event' => $event]);
    }
}

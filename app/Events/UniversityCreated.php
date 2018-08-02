<?php

namespace App\Events;

use App\University;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UniversityCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $university;
    public $password;
    public $user;

    /**
     * Create a new event instance.
     *
     * @param University $university
     * @param            $password
     * @param            $user
     */
    public function __construct(University $university, $password, $user)
    {
        $this->university = $university;
        $this->password = $password;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

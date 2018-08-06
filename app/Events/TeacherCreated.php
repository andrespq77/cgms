<?php

namespace App\Events;

use App\Teacher;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TeacherCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $teacher;
    public $creation_type;

    /**
     * Create a new event instance.
     *
     * @param Teacher $teacher
     * @param int   $creation_type
     */
    public function __construct(Teacher $teacher, $creation_type)
    {
        $this->teacher = $teacher;
        $this->creation_type = $creation_type;
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

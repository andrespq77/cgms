<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class DiplomaUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $path;
    public $filePath;
    public $courseId;

    /**
     * Create a new event instance.
     *
     * @param $path
     * @param $filePath
     * @param $course_id
     */
    public function __construct($path, $filePath, $course_id)
    {
        $this->path = $path;
        $this->filePath = $filePath;
        $this->courseId = $course_id;

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

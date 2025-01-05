<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class Announcement implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $announcement;
   public function __construct($announcement)
    {
        Log::info('Broadcasting event: ', ['announcement' => $this->announcement]);
        
         $this->announcement = $announcement;
    }
    public function broadcastOn()
    {
        return new Channel('announcement');
    }
    public function broadcastAs()
    {
       return 'student-announcement';
    }
}

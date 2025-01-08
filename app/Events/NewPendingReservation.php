<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewPendingReservation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    use Dispatchable, SerializesModels;



    public $reservation;
    public function __construct($reservation)
    {
        Log::info('Broadcasting event: ', ['reservation' => $this->reservation]);

        $this->reservation = $reservation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('reservation');
    }
    public function broadcastAs()
    {
        return 'student-reservation';
    }
}

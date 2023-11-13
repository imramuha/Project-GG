<?php

namespace App\Events;

use App\Models\lobby;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewLounge implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $lobby;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Lobby $lobby)
    {
        $this->lobby = $lobby;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('lounge.' . $this->lobby->code);
    }

    public function broadcastWith() {
        return ["lobby" => $this->lobby];
    }
}

<?php

namespace App\Events;

use App\Events\Ant\Ant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AntEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $ant = null;

    /**
     * Create a new event instance.
     *
     * @param Ant $ant
     */
    public function __construct(Ant $ant)
    {
        $this->ant = $ant;
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

    /**
     * @return Ant|null
     */
    public function getAnt()
    {
        return $this->ant;
    }

    /**
     * @param Ant|null $ant
     */
    public function setAnt($ant)
    {
        $this->ant = $ant;
    }
}

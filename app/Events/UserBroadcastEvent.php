<?php

namespace App\Events;

use App\Models\User\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class UserBroadcastEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $afterCommit = true;

    /**
     * The event model.
     *
     * @var string
     */
    public $model = 'User';

    /**
     * The User instance.
     *
     * @var \App\Models\User\User | int
     */
    public $user;

    /**
     * Event type.
     *
     * @var string
     */
    public $type;

    /**
     * Devices.
     *
     * @var Collection
     */
    public $devices;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User | int $user, string $type, Collection $devices)
    {
        $this->user = $user;
        $this->type = $type;
        $this->devices = $devices;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channels = [];

        foreach ($this->devices as $device) {
            array_push($channels, new PrivateChannel("$device->id"));
        }

        return $channels;
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'broadcastEvent';
    }

    public function broadcastWith() {
        $data = $this->type == 'delete' ? $this->user : $this->user->id;
        
        return [
            'type' => $this->type,
            'model' => $this->model,
            'data' => $data
        ];
    }
}

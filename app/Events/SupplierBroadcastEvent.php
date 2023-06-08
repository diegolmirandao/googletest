<?php

namespace App\Events;

use App\Models\Supplier\Supplier;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class SupplierBroadcastEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $afterCommit = true;

    /**
     * The User instance.
     *
     * @var \App\Models\Supplier\Supplier
     */
    public $supplier;

    /**
     * Event name.
     *
     * @var string
     */
    public $eventName;

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
    public function __construct(Supplier $supplier, string $eventName, Collection $devices)
    {
        $this->supplier = $supplier;
        $this->eventName = $eventName;
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
            array_push($channels, new Channel("$device->id"));
        }

        return $channels;
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'supplier.'.$this->eventName;
    }

    public function broadcastWith() {
        return [
            'id' => $this->supplier->id
        ];
    }
}

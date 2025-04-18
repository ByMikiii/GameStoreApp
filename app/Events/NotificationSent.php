<?php

namespace App\Events;
use App\Models\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

        /**
     * Text
     */
    public $text;

     /**
     * User
     * 
     * @var \App\Models\User
     */
    public $user;

     /**
     * Color
     * 
     */
    public $color;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $text, User $user, string $color)
    {
        $this->text = $text;
        $this->user = $user;
        $this->color = $color;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("notification.{$this->user->id}");;
    }
}

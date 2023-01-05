<?php

namespace App\Events;

use App\Models\User;
use App\Models\Message;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessagePosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Message
     * 
     * @var \App\Models\Message
     */
    public $message;

     /**
     * Sender
     * 
     * @var \App\Models\User
     */
    public $sender;

     /**
     * Receiver
     * 
     * @var \App\Models\User
     */
    public $receiver;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message, User $receiver, User $sender )
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->receiver = $receiver;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat');
    }
}

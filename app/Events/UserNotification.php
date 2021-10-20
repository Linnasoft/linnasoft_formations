<?php

namespace App\Events;

//use Illuminate\Broadcasting\Channel;
//use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $type;
    public $user;
    public $notification_id;

    public function __construct($message, $type, $user, $notification_id)
    {
        $this->message = $message;
        $this->type = $type;
        $this->user = $user;
        $this->notification_id = $notification_id;
    }

    public function broadcastOn()
    {
        return ['user-channel'];
    }

    public function broadcastAs()
    {
        return 'user-notification';
    }
}

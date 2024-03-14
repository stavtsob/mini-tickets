<?php

namespace App\Events;

use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewComment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment, $ticket;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TicketComment $comment, Ticket $ticket)
    {
        $this->comment = $comment;
        $this->ticket = $ticket;
    }

}

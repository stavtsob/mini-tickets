<?php

namespace App\Events\Listeners;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\TicketComment;


class SetTicketInProgress
{

    public function handle($event)
    {
        if($event->comment instanceof TicketComment)
        {
            Ticket::where(['id' =>$event->comment->ticket_id])->update(['status'=>TicketStatus::IN_PROGRESS]);
        }
    }
}

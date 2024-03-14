<?php
namespace App\Events\Listeners\Tickets;

use App\Enums\UserActivityType;
use App\Jobs\UserActivity\LogUserActivityJob;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;

class UpdateTicketEventListener
{
    use DispatchesJobs;

    public function handle($event)
    {
        $ticket = $event->ticket;
        $this->dispatch(new LogUserActivityJob(Auth::user(), UserActivityType::LOG, "Edited ticket \"{$ticket->code} : {$ticket->title}\""));

        notify()->success("Successfully updated ticket " . $ticket->code ." ⚡️");
    }
}

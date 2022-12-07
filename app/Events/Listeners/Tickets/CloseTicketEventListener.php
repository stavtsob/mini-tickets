<?php
namespace App\Events\Listeners\Tickets;

use App\Enums\UserActivityType;
use App\Jobs\UserActivity\LogUserActivityJob;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;

class CloseTicketEventListener
{
    use DispatchesJobs;

    public function handle($event)
    {
        return abort(redirect()->route('home'));
    }
}

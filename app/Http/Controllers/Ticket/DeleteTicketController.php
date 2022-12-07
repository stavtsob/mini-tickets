<?php

namespace App\Http\Controllers\Ticket;

use App\Enums\UserActivityType;
use App\Http\Controllers\Controller;
use App\Jobs\UserActivity\LogUserActivityJob;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DeleteTicketController extends Controller
{
    function delete(Request $request, $ticketCode)
    {
        // Retrieve Ticket
        $ticket = Ticket::where(['code'=>$ticketCode])->first();
        // Delete Ticket associated files
        foreach($ticket->getMedia() as $file)
        {
            $file->delete();
        }
        // Delete ticket
        $ticket->delete();
        // Log and send popup notification to the user
        $this->dispatch(new LogUserActivityJob($request->user(), UserActivityType::WARNING, "Deleted ticket \"$ticketCode\""));
        notify()->success("Successfully deleted ticket " . $ticketCode ." ⚡️");

        return redirect()->route('home');
    }
}

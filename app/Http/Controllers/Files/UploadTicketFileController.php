<?php

namespace App\Http\Controllers\Files;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadTicketFileController extends Controller
{
    public function index(Request $request, $ticketCode)
    {
        $ticket = Ticket::where('code',$ticketCode)->first();
        if(!$ticket)
        {
            abort('Ticket not found',403);
        }

        $ticket->addMediaFromRequest('file')->toMediaCollection();
        return redirect()->route('tickets.view',$ticketCode);
    }
}

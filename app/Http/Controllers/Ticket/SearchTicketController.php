<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class SearchTicketController extends Controller
{
    function searchWithCode(Request $request)
    {
        $data = $request->all();
        if(!array_key_exists('code',$data))
        {
            abort(403);
        }
        $ticketCode = $data['code'];
        $ticket = Ticket::where('code',$ticketCode)->first();
        if(!$ticket)
        {
            notify()->error('No ticket found for code "'.$ticketCode.'".');
            return redirect()->route('home');
        }
        return redirect()->route('tickets.view',$ticketCode);
    }
}

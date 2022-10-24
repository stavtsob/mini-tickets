<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ViewTicketController extends Controller
{
    public function index($ticketCode)
    {
        $ticket = Ticket::where(['code'=>$ticketCode])->first();
        if(!$ticket)
        {
            abort(404, 'This specific ticket code was not found.');
        }

        return view('tickets.view',['ticket'=>$ticket]);
    }
}

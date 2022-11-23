<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;


class TicketReportController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->query('from_date');
        $toDate = $request->query('to_date');

        $tickets = Ticket::query();
        if($fromDate)
        {
            $tickets = $tickets->whereDate('created_at','>=',$fromDate);
        }
        if($toDate)
        {
            $tickets = $tickets->whereDate('created_at','<=',$toDate);
        }
        $tickets = $tickets->get();
        $data = [
            'tickets' => $tickets
        ];
        return view('reports.tickets_report',$data);
    }
}

<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
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
            'tickets' => $tickets,
            'title' => $this->getTitle($fromDate,$toDate)
        ];
        return view('reports.tickets_report',$data);
    }

    protected function getTitle($fromDate,$toDate)
    {
        $title = '';
        if($fromDate)
        {
            $fromDate = Carbon::parse($fromDate)->format('d M Y');
            $title .= __('general.from_date') . ' ';
            $title .= '<span class="date">';
            $title .= $fromDate . ' ' ;
            $title .= '</span>';
        }
        if($toDate)
        {
            $toDate = Carbon::parse($toDate)->format('d M Y');
            $title .= __('general.to_date') . ' ';
            $title .= '<span class="date">';
            $title .= $toDate;
            $title .= '</span>';
        }

        return $title;
    }
}

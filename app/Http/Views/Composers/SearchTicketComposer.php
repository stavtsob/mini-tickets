<?php

namespace App\Http\Views\Composers;

use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchTicketComposer
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data = $this->request->all();
        // Ticket counts by status
        $openTickets = Ticket::where(['status' => 1])->count();
        $inProgressTickets = Ticket::where(['status' => 2])->count();
        $closedTickets = Ticket::where(['status' => 3])->count();

        // Filter tickets
        $statusFilter = $this->request->query('status_filter', 0);
        $departments = Department::all();

        // Collect Tickets
        $searchParam = $data['code'];

        $ticketsByDepartment = $this->initTicketList($departments);
        $tickets = Ticket::search($searchParam)->orderBy('priority','DESC')->get();

        foreach($tickets as $ticket)
        {
            $ticketsByDepartment[$ticket->department][] = $ticket;
        }


        $view->with([
            'tickets'           => $ticketsByDepartment ?? [],
            'search_param'      => $searchParam,
            'statusFilter'      => $statusFilter,
            'closedTickets'     => $closedTickets ?? 0,
            'openTickets'       => $openTickets ?? 0,
            'inProgressTickets' => $inProgressTickets ?? 0,
            'departments'       => $departments
        ]);
    }


    private function initTicketList($departments)
    {
        $ticketsByDepartment = [];
        foreach($departments as $d)
        {
            $ticketsByDepartment[$d->code] = [];
        }
        return $ticketsByDepartment;
    }
}

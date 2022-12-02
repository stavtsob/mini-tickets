<?php

namespace App\View\Composers;

use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketListComposer
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
        // Ticket counts by status
        $openTickets = Ticket::where(['status' => 1])->count();
        $inProgressTickets = Ticket::where(['status' => 2])->count();
        $closedTickets = Ticket::where(['status' => 3])->count();

        // Filter tickets
        $statusFilter = $this->request->query('status_filter', 0);
        $departments = Department::all();

        // Collect Tickets
        $ticketsByDepartment = [];
        foreach($departments as $department)
        {
            $tickets = $statusFilter == 0 ? Ticket::where('status', '<', 3) : Ticket::where('status', $statusFilter);
            $ticketsByDepartment[$department->code] = $tickets->where('department', $department->code)->orderBy('priority', 'DESC')->get();
        }


        $view->with([
            'tickets'           => $ticketsByDepartment ?? [],
            'statusFilter'      => $statusFilter,
            'closedTickets'     => $closedTickets ?? 0,
            'openTickets'       => $openTickets ?? 0,
            'inProgressTickets' => $inProgressTickets ?? 0,
            'departments'       => $departments
        ]);
    }
}
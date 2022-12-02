<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $openTickets = Ticket::where(['status' => 1])->count();
        $inProgressTickets = Ticket::where(['status' => 2])->count();
        $closedTickets = Ticket::where(['status' => 3])->count();

        // Filter tickets
        $statusFilter = $request->query('status_filter', 0);
        $tickets = $statusFilter == 0 ? Ticket::where('status', '<', 3) : Ticket::where('status', $statusFilter);
        $tickets = $tickets->orderBy('priority', 'DESC')->get();

        return view('home', [
            'tickets'           => $tickets ?? [],
            'statusFilter'      => $statusFilter,
            'openTickets'       => $openTickets ?? 0,
            'inProgressTickets' => $inProgressTickets ?? 0,
            'closedTickets' => $closedTickets ?? 0
        ]);
    }
}

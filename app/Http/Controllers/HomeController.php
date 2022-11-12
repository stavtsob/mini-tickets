<?php

namespace App\Http\Controllers;

use App\Models\Department;
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
        // $openTickets = Ticket::where(['status' => 1])->count();
        // $inProgressTickets = Ticket::where(['status' => 2])->count();
        // $tickets = Ticket::where('status', '<', 3);
        // $closedTickets = Ticket::where('status', '=', 3)->orderBy('created_at', 'DESC')->get();

        // // Filter tickets
        // $statusFilter = $request->query('status_filter', 0);
        // $departments = Department::all();
        // $tickets = $statusFilter == 0 ? $tickets : $tickets->where('status', $statusFilter);

        // $ticketsByDepartment = [];
        // foreach($departments as $department)
        // {
        //     $ticketsByDepartment[$department->code] = $tickets->where('department', $department->code)->orderBy('priority', 'DESC')->get();
        // }


        return view('home');
    }
}

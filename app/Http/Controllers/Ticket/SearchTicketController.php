<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class SearchTicketController extends Controller
{
    function search(Request $request)
    {
        $data = $request->all();
        if(!array_key_exists('code',$data))
        {
            abort(403);
        }


        return view('tickets.search_results');
    }
}

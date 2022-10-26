<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketCommentController extends Controller
{
    function create(Request $request)
    {
        $data = $request->all();
        $this->validateCommentCreation($data);

        TicketComment::create([
            'ticket_id' => $data['ticket_id'],
            'user_id'   => Auth::user()->id,
            'comment'   => $data['comment']
        ]);

        $ticket = Ticket::where('id',$data['ticket_id'])->first();
        notify()->success("Comment successfully posted⚡️");
        return redirect()->route('tickets.view', $ticket->code);
    }

    protected function validateCommentCreation($data)
    {
        return Validator::make($data, [
            'ticket_id' => ['required', 'integer'],
            'comment' => ['sometimes', 'string', 'max:500'],
        ])->validate();
    }
}

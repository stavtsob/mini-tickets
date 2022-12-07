<?php

namespace App\Http\Controllers\Ticket;

use App\Enums\UserActivityType;
use App\Events\CloseTicketEvent;
use App\Events\UpdateTicketEvent;
use App\Http\Controllers\Controller;
use App\Jobs\UserActivity\LogUserActivityJob;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditTicketController extends Controller
{
    function update(Request $request, $ticketCode)
    {
        $ticket = Ticket::where(['code'=>$ticketCode])->first();
        if(!$ticket)
        {
            abort(403,'Ticket code not found.');
        }

        $data = $request->all();
        $validator = $this->validator($data);
        if($validator->fails())
        {
            notify()->error($validator->errors()->first());
        }

        $result = Ticket::where(['id'=>$ticket->id])
                        ->update([
                            'title' => $data['title'],
                            'refers_to' => $data['refers_to'],
                            'department' => $data['department'],
                            'description'    => $data['description'],
                            'priority'  => intval($data['priority']),
                            'status'  => intval($data['status']),
                            'telephone' => $data['telephone'],
                            'deadline'  => $data['deadline']
                        ]);

        // Dispatch events
        UpdateTicketEvent::dispatch($ticket);
        if($data['status'] == 3) CloseTicketEvent::dispatch($ticket);

        return redirect()->route('tickets.view', $ticketCode);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'refers_to' => ['sometimes','max:100'],
            'telephone' => ['sometimes', 'max:20'],
            'department' => ['sometimes', 'max:100'],
            'description' => ['sometimes', 'string', 'max:1000'],
        ]);
    }
}

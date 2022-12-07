<?php

namespace App\Http\Controllers\Ticket;

use App\Enums\UserActivityType;
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
        $this->validator($data)->validate();

        $ticket = Ticket::where(['id'=>$ticket->id])
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
        $this->dispatch(new LogUserActivityJob($request->user(), UserActivityType::LOG, "Edited ticket \"$ticketCode : $data[title]\""));
        notify()->success("Successfully updated ticket " . $ticketCode ." ⚡️");

        return redirect()->route('tickets.view', $ticketCode);
    }

    function delete(Request $request, $ticketCode)
    {
        // Retrieve Ticket
        $ticket = Ticket::where(['code'=>$ticketCode])->first();
        // Delete Ticket associated files
        foreach($ticket->getMedia() as $file)
        {
            $file->delete();
        }
        // Delete ticket
        $ticket->delete();
        // Log and send popup notification to the user
        $this->dispatch(new LogUserActivityJob($request->user(), UserActivityType::WARNING, "Deleted ticket \"$ticketCode\""));
        notify()->success("Successfully deleted ticket " . $ticketCode ." ⚡️");

        return redirect()->route('home');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'refers_to' => ['required','max:100'],
            'telephone' => ['sometimes', 'max:20'],
            'department' => ['sometimes', 'max:100'],
            'description' => ['sometimes', 'string', 'max:1000'],
        ]);
    }
}

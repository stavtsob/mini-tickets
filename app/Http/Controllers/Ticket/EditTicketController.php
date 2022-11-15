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
        $validator = $this->validator($data);
        if($validator->fails())
        {
            notify()->error($validator->errors()->first());
        }

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
        $ticket = Ticket::where(['code'=>$ticketCode])->first()->delete();
        $this->dispatch(new LogUserActivityJob($request->user(), UserActivityType::WARNING, "Deleted ticket \"$ticketCode\""));

        notify()->success("Successfully deleted ticket " . $ticketCode ." ⚡️");
        return redirect()->route('home');
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

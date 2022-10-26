<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
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
                            'telephone' => $data['telephone']
                        ]);
        notify()->success("Successfully updated ticket " . $ticketCode ." ⚡️");
        return redirect()->route('home');
    }

    function delete(Request $request, $ticketCode)
    {
        $ticket = Ticket::where(['code'=>$ticketCode])->first()->delete();
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

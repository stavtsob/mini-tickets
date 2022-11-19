<?php

namespace App\Http\Controllers\Files;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadTicketFileController extends Controller
{
    public function index(Request $request, $ticketCode)
    {
        $ticket = Ticket::where('code',$ticketCode)->first();
        if(!$ticket)
        {
            abort('Ticket not found',403);
        }
        $validator = $this->validator($request->all());
        if($validator->fails())
        {
            return redirect()->route('tickets.view',$ticketCode)->withErrors($validator);
        }

        $ticket->addMediaFromRequest('file')->toMediaCollection();
        return redirect()->route('tickets.view',$ticketCode);
    }

    protected function validator($data)
    {
        $mimes = Validator::make($data, [
            'file' => 'required|file|max:10240',
        ]);

        return $mimes;
    }
}

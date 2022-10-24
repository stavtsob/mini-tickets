<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Support\Str;
use App\Models\Ticket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateTicketController extends Controller
{
    function index()
    {
        return view('tickets.create', ['ticket_code'=> $this->generateTicketCode()]);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'code' => ['required', 'string','max:7','unique:tickets'],
            'title' => ['required', 'string', 'max:255'],
            'refers_to' => ['required', 'string', 'max:100'],
            'department' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
        ]);
    }
    function create(Request $request)
    {
        $data = $request->all();
        $this->validator($data)->validate();
        $user = Ticket::create([
            'author_id' => $request->user()->id,
            'code'  => $data['code'],
            'title' => $data['title'],
            'refers_to' => $data['refers_to'],
            'department' => $data['department'],
            'description'    => $data['description'],
            'priority'  => intval($data['priority']),
            'status'  => intval($data['status']),
        ]);

        notify()->success("Successfully create ticket " . $data['code'] ." ⚡️");
        return redirect()->route('home');
    }

    function generateTicketCode()
    {
        return strtoupper(Str::random(2) . '-' . rand(1000,9999));
    }
}

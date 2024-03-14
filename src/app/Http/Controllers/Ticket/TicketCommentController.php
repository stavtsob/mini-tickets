<?php

namespace App\Http\Controllers\Ticket;

use App\Events\NewComment;
use App\Http\Controllers\Controller;
use App\Jobs\Notification\CreateNotificationJob;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketCommentController extends Controller
{
    function create(Request $request)
    {
        $data = $request->all();
        $this->validateCommentCreation($data);

        $ticket = Ticket::where('id',$data['ticket_id'])->first();
        $commentBody = $this->replaceUsernames($data['comment'], $ticket->code);

        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id'   => Auth::user()->id,
            'comment'   => $commentBody
        ]);

        $ticket = Ticket::where('id',$data['ticket_id'])->first();

        NewComment::dispatch($comment, $ticket);
        return redirect()->route('tickets.view', $ticket->code);
    }

    protected function validateCommentCreation($data)
    {
        return Validator::make($data, [
            'ticket_id' => ['required', 'integer'],
            'comment' => ['sometimes', 'string', 'max:500'],
        ])->validate();
    }

    function delete(Request $request, $commentId)
    {
        $currentUser = Auth::user();
        $comment = TicketComment::where('id',$commentId)->first();
        if(!$comment)
        {
            abort(403);
        }
        if($comment->user_id != $currentUser->id && $currentUser->role != 2)
        {
            abort(403);
        }

        $ticket = Ticket::where('id',$comment->ticket_id)->first();
        $comment->delete();
        notify()->info("Comment was deleted!⚡️");
        return redirect()->route('tickets.view', $ticket->code);
    }

    protected function replaceUsernames($body, $ticketCode)
    {
        preg_match_all('/@(\w+.\w+)/', $body, $users);
        if (!isset($users[1])) {
            return $body;
        }
        $userList = User::whereIn('username', $users[1])->get()->unique();
        foreach ($userList as $user) {
            $replace = $user->username;
            $replace = $user->id;

            $body = str_replace('@' . $user->username,
                '<a href="/users/profile/' . $replace . '">@' . $user->username . '</a>', $body);

            $this->dispatch(new CreateNotificationJob($user->id, __('general.username_reference_to', ['code'=>$ticketCode]), route('tickets.view', $ticketCode), Auth::user()->id));
        }
        return $body;
    }

}

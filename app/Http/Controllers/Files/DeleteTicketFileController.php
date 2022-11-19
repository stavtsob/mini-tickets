<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeleteTicketFileController extends Controller
{
    public function delete(Request $request, $fileUuid)
    {
        $file = Media::findByUuid($fileUuid);
        if(!$file)
        {
            abort('file not found');
        }

        $ticket = Ticket::where('id',$file->model_id)->first();
        if($ticket && ($ticket->author_id == Auth::user()->id || Auth::user()->id == 2))
        {
            $file->delete();
        }
        return redirect()->route('tickets.view',$ticket->code);
    }
}

<?php

namespace App\Events\Listeners\Notifications;

use App\Jobs\Notification\CreateNotificationJob;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;

class NewCommentNotification
{
    use DispatchesJobs;

    public function handle($event)
    {
        $ticket = $event->ticket;
        $comment = $event->comment;
        $commentAuthorId = $comment->user_id;
        $commentAuthor = User::where('id',$commentAuthorId)->first();

        $receiverIds = [];

        $allComments = $ticket->comments();
        // Case #1: Comment author different than ticket author
        if($ticket->author_id != $commentAuthorId)
        {
            $receiverIds[] = $ticket->author_id;
        }
        // Case #2: Users that commented the ticket before
        foreach($allComments as $otherComment)
        {
            $otherUserId = $otherComment->user_id;
            if($otherUserId != $commentAuthorId && !in_array($otherUserId,$receiverIds))
            {
                $receiverIds[] = $otherUserId;
            }
        }

        // Create a notification for each user
        foreach($receiverIds as $receiverId)
        {
            $translationVars = [
                'code'=>$ticket->code,
                'user_name'=>$commentAuthor->name
            ];
            $this->dispatch(new CreateNotificationJob($receiverId, __('general.new_comment_notification',$translationVars), route('tickets.view',$ticket->code).'#comment-'.$comment->id));
        }

        notify()->success("Comment successfully posted⚡️");
    }
}

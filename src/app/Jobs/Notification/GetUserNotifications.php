<?php

namespace App\Jobs\Notification;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class GetUserNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = Auth::user();
        if(!$user)
        {
            return [];
        }
        $notifications = Notification::where('user_id',$user->id)
                                    ->where('created_at','>=', Carbon::now()->subDays(7))
                                    ->orderBy('created_at','DESC')
                                    ->limit(10)
                                    ->get();
        foreach($notifications as $i=>$notification)
        {
            $diffInMinutes = Carbon::now()->diffInMinutes($notification->created_at);
            $diffInHours = Carbon::now()->diffInHours($notification->created_at);
            $diffInDays = Carbon::now()->diffInDays($notification->created_at);

            $timeLabel = '';
            if($diffInMinutes < 60)
            {
                $timeLabel = __('general.diff_in_minutes',['diff'=>$diffInMinutes]);
            }
            elseif($diffInHours < 24)
            {
                $timeLabel = __('general.diff_in_hours',['diff'=>$diffInHours]);
            }
            else
            {
                $timeLabel = __('general.diff_in_days',['diff'=>$diffInDays]);
            }
            $notification->timeLabel = $timeLabel;
        }
        return $notifications;
    }
}

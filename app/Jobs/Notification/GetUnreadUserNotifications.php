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

class GetUnreadUserNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

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
        $unreadNotifications = Notification::where('user_id',$user->id)
                                    ->where('seen',0)
                                    ->where('created_at','>=', Carbon::now()->subDays(7))
                                    ->orderBy('created_at','DESC')
                                    ->limit(10)
                                    ->get();
        return $unreadNotifications;
    }
}

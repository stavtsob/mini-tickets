<?php

namespace App\Jobs\UserActivity;

use App\Models\UserActivity;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogUserActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user,$type,$title;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,int $type,string $title)
    {
        $this->user = $user;
        $this->type = $type;
        $this->title = $title;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        UserActivity::create([
            'user_id'   => $this->user->id,
            'type'      => $this->type,
            'title'     => $this->title
        ]);
    }
}

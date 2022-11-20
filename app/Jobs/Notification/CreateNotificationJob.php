<?php

namespace App\Jobs\Notification;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user_id, $content, $url, $author_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $content, $url=null, $author_id=null)
    {
        $this->user_id = $user_id;
        $this->content = $content;
        $this->url = $url;
        $this->author_id = $author_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::create([
            'user_id'   => $this->user_id,
            'content'   => $this->content,
            'url'   => $this->url,
            'author_id'   => $this->author_id
        ]);
    }
}

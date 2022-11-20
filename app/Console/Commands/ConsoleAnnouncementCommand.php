<?php

namespace App\Console\Commands;

use App\Jobs\Notification\CreateNotificationJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ConsoleAnnouncementCommand extends Command
{
    use DispatchesJobs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'announcement:all {anouncement}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an announcement using command line. Remember to use quotes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        $anouncement = $this->argument('anouncement');

        foreach($users as $user)
        {
            $this->dispatchSync(new CreateNotificationJob($user->id,$anouncement));
        }
        return Command::SUCCESS;
    }
}

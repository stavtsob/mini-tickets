<?php

namespace App\Http\Views\Composers;

use App\Jobs\Notification\GetUnreadUserNotifications;
use App\Jobs\Notification\GetUserNotifications;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationsViewComposer
{
    use DispatchesJobs;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $notifications = $this->dispatchSync(new GetUserNotifications());
        $unreadNotifications = $this->dispatchSync(new GetUnreadUserNotifications());

        $view->with([
            'notifications' => $notifications ?? [],
            'unreadNotifications' => $unreadNotifications ?? []
        ]);
    }
}

<?php

namespace App\Providers;

use App\Http\Views\Composers\NotificationsViewComposer;
use App\View\Composers\TicketListComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.notifications', NotificationsViewComposer::class);
        View::composer('home', TicketListComposer::class);
    }
}

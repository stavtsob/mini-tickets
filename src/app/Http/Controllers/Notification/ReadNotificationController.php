<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ReadNotificationController extends Controller
{
    public function readNotification(Request $request)
    {
        $notificationId = $request->post('notificationId');
        $notification = Notification::where('id',$notificationId)->first();
        if(!$notification || $notification->user_id != Auth::user()->id)
        {
            abort(500,'not allowed');
        }

        $notification->seen = true;
        $notification->save();

        return Response('OK',200);
    }
}

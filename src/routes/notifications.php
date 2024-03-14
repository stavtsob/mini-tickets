<?php

use App\Http\Controllers\Notification\ReadNotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Notification Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/read', [ReadNotificationController::class, 'readNotification'])->name('notifications.read');


<?php

use App\Http\Controllers\Files\DeleteTicketFileController;
use App\Http\Controllers\Files\DownloadFileController;
use App\Http\Controllers\Files\UploadTicketFileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| File Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/upload/ticket/{ticketCode}', [UploadTicketFileController::class, 'index'])->name('files.tickets.upload');
Route::get('/download/{fileUuid}', [DownloadFileController::class, 'download'])->name('files.download');
Route::post('/delete/{fileUuid}', [DeleteTicketFileController::class, 'delete'])->name('files.delete');


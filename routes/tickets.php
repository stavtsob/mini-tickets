<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/reports', [App\Http\Controllers\TicketReportController::class, 'index'])->name('tickets.report');

Route::get('/create', [App\Http\Controllers\Ticket\CreateTicketController::class, 'index'])->name('tickets.create_page');
Route::post('/create', [App\Http\Controllers\Ticket\CreateTicketController::class, 'create'])->name('tickets.create');
Route::get('/{ticketCode}', [App\Http\Controllers\Ticket\ViewTicketController::class, 'index'])->name('tickets.view');
Route::post('/edit/{ticketCode}', [App\Http\Controllers\Ticket\EditTicketController::class, 'update'])->name('tickets.update');
Route::post('/delete/{ticketCode}', [App\Http\Controllers\Ticket\EditTicketController::class, 'delete'])->name('tickets.delete');
Route::post('/search', [App\Http\Controllers\Ticket\SearchTicketController::class, 'search'])->name('tickets.search');
Route::post('/comment', [App\Http\Controllers\Ticket\TicketCommentController::class, 'create'])->name('tickets.comments.create');
Route::get('/comment/{commentId}/delete', [App\Http\Controllers\Ticket\TicketCommentController::class, 'delete'])->name('tickets.comments.delete');




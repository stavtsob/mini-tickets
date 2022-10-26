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


Route::get('/create', [App\Http\Controllers\Ticket\CreateTicketController::class, 'index'])->name('tickets.create_page');
Route::post('/create', [App\Http\Controllers\Ticket\CreateTicketController::class, 'create'])->name('tickets.create');
Route::get('/{ticketCode}', [App\Http\Controllers\Ticket\ViewTicketController::class, 'index'])->name('tickets.view');
Route::post('/edit/{ticketCode}', [App\Http\Controllers\Ticket\EditTicketController::class, 'update'])->name('tickets.update');
Route::post('/delete/{ticketCode}', [App\Http\Controllers\Ticket\EditTicketController::class, 'delete'])->name('tickets.delete');
Route::post('/search-with-code', [App\Http\Controllers\Ticket\SearchTicketController::class, 'searchWithCode'])->name('tickets.search_with_code');



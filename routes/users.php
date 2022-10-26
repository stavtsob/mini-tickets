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


Route::middleware('admin')->get('/create', [App\Http\Controllers\Auth\CreateUserController::class, 'index'])->name('users.create');
Route::middleware('admin')->post('/create', [App\Http\Controllers\Auth\CreateUserController::class, 'create'])->name('users.create_request');
Route::get('/list',[App\Http\Controllers\UserListController::class, 'index'])->name('users.list');
Route::get('/profile', [App\Http\Controllers\Auth\ProfileController::class, 'index'])->name('users.profile');
Route::get('/profile/{userId}', [App\Http\Controllers\Auth\ProfileController::class, 'index'])->name('users.other_profile');
Route::post('/profile/{userId}/update', [App\Http\Controllers\Auth\ProfileController::class, 'update'])->name('users.update');
Route::post('/profile/change-password', [App\Http\Controllers\Auth\ProfileController::class, 'changePassword'])->name('users.change_password');
Route::post('/profile/delete', [App\Http\Controllers\Auth\ProfileController::class, 'deleteUser'])->name('users.delete');



